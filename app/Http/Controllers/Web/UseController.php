<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\EventAttendance;
use App\Models\DocumentType;
use App\Models\UserType;
use App\Models\Gender;
use App\Models\User;
use App\Models\Modality;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UseController extends Controller
{
   /**
     * Muestra la lista principal de usuarios con estadísticas
     * - Calcula total de usuarios, activos, inactivos y diplomas descargados
     * - Carga usuarios paginados con relaciones para optimizar consultas
     * - Prepara datos para las cards estadísticas y la tabla principal
     */
    public function index()
    {
        // Calcular estadísticas para las cards del dashboard
        $totalUsers = User::count(); // Total de usuarios registrados
        $activeUsers = User::where('status', true)->count(); // Usuarios activos
        $inactiveUsers = User::where('status', false)->count(); // Usuarios inactivos
        $downloadedDiplomas = User::where('is_downloaded', true)->count(); // Usuarios que han descargado su diploma

        // Obtener usuarios con eager loading para evitar problema N+1
        $users = User::with(['roles', 'gender', 'userType', 'documentType', 'modality'])
            ->orderBy('created_at', 'desc') // Ordenar por más recientes primero
            ->paginate(10); // Paginación de 10 registros por página

        $search = '';

        return view('user.index', compact('users', 'totalUsers', 'activeUsers', 'inactiveUsers', 'downloadedDiplomas', 'search'));
    }

    /**
     * Búsqueda AJAX de usuarios - Procesa búsquedas en tiempo real
     * - Recibe término de búsqueda por GET
     * - Filtra por nombre, email, documento o teléfono
     * - Retorna HTML actualizado de la tabla y estadísticas
     * - Usado para búsqueda sin recargar página
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $query = User::with(['roles', 'gender', 'userType', 'documentType', 'modality'])
            ->orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                    ->orWhere('last_name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('document_number', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Ejecutar consulta paginada
        $users = $query->paginate(10);

        // Recalcular estadísticas para actualizar las cards
        $totalUsers = User::count();
        $activeUsers = User::where('status', true)->count();
        $inactiveUsers = User::where('status', false)->count();
        $downloadedDiplomas = User::where('is_downloaded', true)->count();

        // Renderizar solo la parte de la tabla para AJAX (sin layout completo)
        $html = view('user.components.table', compact('users'))->render();

        // Retornar respuesta JSON para JavaScript
        return response()->json([
            'success' => true,
            'html' => $html, // HTML actualizado de la tabla
            'total' => $users->total(), // Total de resultados encontrados
            'search' => $search, // Término de búsqueda utilizado
            'stats' => [// Estadísticas actualizadas para las cards
                'total' => $totalUsers,
                'active' => $activeUsers,
                'inactive' => $inactiveUsers,
                'downloaded' => $downloadedDiplomas
            ]
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario
     * - Carga todos los datos necesarios para los dropdowns del formulario
     * - Incluye géneros, tipos de documento, tipos de usuario y roles disponibles
     */
    public function create()
    {
        // Obtener datos para los formularios de creación
        $genders = Gender::orderBy('name')->get(); // Todos los géneros ordenados
        $documentTypes = DocumentType::orderBy('name')->get(); // Todos los tipos de documento ordenados
        $userTypes = UserType::where('is_active', true)->orderBy('type')->get(); // Tipos de usuario activos
        $roles = Role::orderBy('name')->get(); // Todos los roles disponibles

        $modalities = Modality::where('is_active', true)->orderBy('name')->get();

        return view('user.create', compact('genders', 'documentTypes', 'userTypes', 'roles', 'modalities'));
    }

      /**
     * Almacena un nuevo usuario en la base de datos
     * - Valida los datos del formulario con reglas específicas
     * - Genera UUID único y hashea la contraseña
     * - Maneja la subida de foto de perfil al storage
     * - Asigna rol si se especifica
     * - Maneja errores con try-catch para mejor experiencia de usuario
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'phone' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:100',
                'city' => 'nullable|string|max:100',
                'birthdate' => 'nullable|date',
                'gender_id' => 'required|exists:genders,id',
                'document_type_id' => 'required|exists:document_types,id',
                'document_number' => 'required|string|max:50|unique:users,document_number',
                'user_type_id' => 'required|exists:user_types,id',
                'modality_id' => 'required|exists:modalitys,id',
                'status' => 'nullable|boolean',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'role' => 'nullable|exists:roles,name',
            ]);

            $validated['uuid'] = Str::uuid();
            $validated['password'] = Hash::make($validated['password']);
            $validated['status'] = $validated['status'] ?? true;

            // Manejar subida de foto de perfil si se proporcionó
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = 'profiles/' . Str::uuid() . '.' . $photo->getClientOriginalExtension();
                Storage::disk('local')->put($photoName, file_get_contents($photo->getRealPath()));
                $validated['photo'] = $photoName;
            }

            // Crear usuario en la base de datos
            $user = User::create($validated);

            // Asignar rol si se proporcionó
            if (isset($validated['role'])) {
                $user->assignRole($validated['role']);
            }

            return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para editar un usuario existente
     * - Busca usuario por UUID (identificador único)
     * - Carga relaciones necesarias para mostrar datos actuales
     * - Prepara datos para los dropdowns del formulario de edición
     */
    public function edit($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $user->load(['gender', 'documentType', 'userType', 'roles', 'modality']);

            $genders = Gender::orderBy('name')->get();
            $documentTypes = DocumentType::orderBy('name')->get();
            $userTypes = UserType::where('is_active', true)->orderBy('type')->get();
            $roles = Role::orderBy('name')->get();

            $modalities = Modality::where('is_active', true)->orderBy('name')->get();

            return view('user.edit', compact('user', 'genders', 'documentTypes', 'userTypes', 'roles', 'modalities'));

        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Usuario no encontrado');
        }
    }

     /**
     * Actualiza un usuario existente en la base de datos
     * - Valida datos excluyendo al usuario actual en reglas unique
     * - Maneja actualización de foto (elimina anterior y sube nueva)
     * - Actualiza rol si se especifica
     * - Mantiene compatibilidad con datos existentes
     */
    public function update(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'country' => 'nullable|string|max:100',
                'city' => 'nullable|string|max:100',
                'birthdate' => 'nullable|date',
                'gender_id' => 'required|exists:genders,id',
                'document_type_id' => 'required|exists:document_types,id',
                'document_number' => 'required|string|max:50|unique:users,document_number,' . $user->id,
                'user_type_id' => 'required|exists:user_types,id',
                'modality_id' => 'required|exists:modalitys,id', // ✅ CORREGIDO: modalitys en lugar de modalities
                'status' => 'nullable|boolean',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'role' => 'nullable|exists:roles,name',
            ]);

            // Manejar actualización de foto si se proporciona nueva
            if ($request->hasFile('photo')) {
                $oldPhotoPath = $user->getRawOriginal('photo');

                if ($oldPhotoPath && Storage::disk('local')->exists($oldPhotoPath)) {
                    Storage::disk('local')->delete($oldPhotoPath);
                }

                $photo = $request->file('photo');
                $photoName = 'profiles/' . Str::uuid() . '.' . $photo->getClientOriginalExtension();
                Storage::disk('local')->put($photoName, file_get_contents($photo->getRealPath()));
                $validated['photo'] = $photoName;
            }

            $validated['status'] = isset($validated['status']) ? (bool) $validated['status'] : true;
            
            // Un solo update
            $updateResult = $user->update($validated);
            
            $user->refresh(); // Asegura la variable user este actualizada

            // Actualizar rol
            if (isset($validated['role'])) {
                $user->syncRoles([$validated['role']]);
            }

            return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

     /**
     * Elimina un usuario de la base de datos (Soft Delete)
     * - Busca usuario por UUID
     * - Elimina foto de perfil del storage si existe
     * - Realiza soft delete del usuario (no eliminación permanente)
     * - Retorna JSON para AJAX
     */
    public function destroy($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $photoPath = $user->getRawOriginal('photo');

            if ($photoPath && Storage::disk('local')->exists($photoPath)) {
                Storage::disk('local')->delete($photoPath);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Usuario eliminado correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage()
            ], 500);
        }
    }

     /**
     * Cambia el estado activo/inactivo de un usuario (Toggle)
     * - Invierte el valor actual del campo status
     * - Guarda el cambio en la base de datos
     * - Retorna estadísticas actualizadas para las cards
     * - Usado desde los botones de la tabla via AJAX
     */
    public function toggleStatus($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $user->status = !$user->status; // Invertir estado (true->false, false->true)
            $user->save();

            $totalUsers = User::count();
            $activeUsers = User::where('status', true)->count();
            $inactiveUsers = User::where('status', false)->count();
            $downloadedDiplomas = User::where('is_downloaded', true)->count();

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente',
                'status' => $user->status, // Nuevo estado del usuario
                'stats' => [ // Estadísticas actualizadas
                    'total' => $totalUsers,
                    'active' => $activeUsers,
                    'inactive' => $inactiveUsers,
                    'downloaded' => $downloadedDiplomas
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

   /**
     * Método genérico para cambiar campos booleanos via AJAX
     * - Maneja múltiples campos: is_admin, is_invited, is_paid, is_downloaded, kit_confirmed
     * - Valida que el campo sea de los permitidos por seguridad
     * - Actualiza dinámicamente el campo especificado
     * - Retorna mensaje traducido según el campo modificado
     */
        public function toggleBoolean(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();

            $request->validate([
                'field' => 'required|string|in:is_admin,is_invited,is_paid,is_downloaded,kit_confirmed',
                'value' => 'required|boolean'
            ]);

            $field = $request->field;
            $newValue = $request->value;
            $currentValue = $user->$field;
            $isAdmin = auth()->check() && auth()->user()->is_admin; // o como manejes el rol admin

            // 🔐 Si no es admin e intenta revertir de true → false
            if (!$isAdmin && $currentValue && $newValue === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Solo el administrador puede hacer el cambio.'
                ], 403);
            }

            // 🔐 Si no es admin e intenta activar un campo diferente a is_paid o kit_confirmed → bloquear
            if (!$isAdmin && !$currentValue && $newValue === true && !in_array($field, ['is_paid', 'kit_confirmed'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'No tienes permisos para activar este campo.'
                ], 403);
            }

            // ✅ Actualizar el campo
            $user->$field = $newValue;
            $user->save();

            // 📊 Recalcular estadísticas después del cambio
            $totalUsers = User::count();
            $activeUsers = User::where('status', true)->count();
            $inactiveUsers = User::where('status', false)->count();
            $downloadedDiplomas = User::where('is_downloaded', true)->count();

            $fieldLabels = [
                'is_admin' => 'administrador',
                'is_invited' => 'invitado',
                'is_paid' => 'estado de refrigerio',
                'is_downloaded' => 'descarga de diploma',
                'kit_confirmed' => 'confirmación de kit'
            ];

            $action = $newValue ? 'activado' : 'desactivado';
            $fieldLabel = $fieldLabels[$field] ?? $field;

            return response()->json([
                'success' => true,
                'message' => "Campo {$fieldLabel} {$action} correctamente",
                'field' => $field,
                'value' => $newValue,
                'stats' => [
                    'total' => $totalUsers,
                    'active' => $activeUsers,
                    'inactive' => $inactiveUsers,
                    'downloaded' => $downloadedDiplomas
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el campo: ' . $e->getMessage()
            ], 500);
        }
    }


   /** 
     * Cambia el estado de descarga de diploma de un usuario 
     * - SOLO permite marcar como descargado si el usuario tiene asistencias confirmadas 
     * - Compatible con sistema antiguo (toggle) y nuevo (valor específico) 
     * - Permite tanto invertir estado como establecer valor específico 
     * - Retorna estadística actualizada de diplomas descargados 
     * - Usado desde la interfaz de diplomas 
     */
    public function toggleDiploma(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();

            //  VERIFICAR SI EL USUARIO TIENE ASISTENCIAS CONFIRMADAS 
            $hasConfirmedAttendances = EventAttendance::where('user_id', $user->id)
                ->where('status', true) // Asistencia confirmada 
                ->exists();

            //  Obtener el valor deseado del request o hacer toggle 
            $desiredValue = $request->has('value') ? $request->value : !$user->is_downloaded;

            //  VALIDACIÓN: No permitir activar descarga si no tiene asistencias confirmadas 
            if ($desiredValue === true && !$hasConfirmedAttendances) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede marcar diploma como descargado. El usuario no tiene asistencias confirmadas a eventos.'
                ], 422);
            }

            //  ACTUALIZAR ESTADO DE DESCARGA 
            $user->is_downloaded = $desiredValue;
            $user->save();

            // ✅ Calcular TODAS las estadísticas, no solo downloaded 
            $totalUsers = User::count();
            $activeUsers = User::where('status', true)->count();
            $inactiveUsers = User::where('status', false)->count();
            $downloadedDiplomas = User::where('is_downloaded', true)->count();

            return response()->json([
                'success' => true,
                'message' => $user->is_downloaded ?
                    'Diploma marcado como descargado' :
                    'Descarga de diploma desmarcada',
                'is_downloaded' => $user->is_downloaded,
                'stats' => [ // incluye todas las estadísticas 
                    'total' => $totalUsers,
                    'active' => $activeUsers,
                    'inactive' => $inactiveUsers,
                    'downloaded' => $downloadedDiplomas
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado del diploma',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Actualiza la contraseña de un usuario
     * - Valida que las contraseñas coincidan (confirmed)
     * - Hashea la nueva contraseña antes de guardar
     * - Actualiza directamente el campo password
     * - Retorna JSON para AJAX
     */
    public function updatePassword(Request $request, $uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();

            $request->validate([
                'password' => 'required|string|min:8|confirmed'
            ]);

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Actualizar contraseña hasheada por seguridad
            return response()->json([
                'success' => true,
                'message' => 'Contraseña actualizada correctamente'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la contraseña: ' . $e->getMessage()
            ], 500);
        }
    }

     /** 
     * Acción masiva para diplomas - Activar/Desactivar/Invertir todos los diplomas 
     * - SOLO activa diplomas para usuarios con asistencias confirmadas 
     * - Ejecuta operaciones masivas en la base de datos 
     * - Tres acciones: activar todos, desactivar todos, invertir estados 
     * - Usa consultas eficientes UPDATE para mejor rendimiento 
     * - Retorna estadísticas actualizadas y conteo de registros afectados 
     */
    public function massDiplomaAction(Request $request)
    {
        try {
            $request->validate([
                'action' => 'required|string|in:activate,deactivate,toggle_all'
            ]);

            $action = $request->action;
            $affectedRows = 0;

            //OBTENER USUARIOS CON ASISTENCIAS CONFIRMADAS 
            $usersWithConfirmedAttendances = User::whereHas('eventAttendances', function ($query) {
                $query->where('status', true); // Solo asistencias confirmadas 
            })->pluck('id');

            //  Ejecutar acción específica según lo solicitado 
            switch ($action) {
                case 'activate':
                    // ✅ Activar diplomas SOLO para usuarios con asistencias confirmadas 
                    $affectedRows = User::whereIn('id', $usersWithConfirmedAttendances)
                        ->where('is_downloaded', false)
                        ->update(['is_downloaded' => true]);
                    $message = "Diplomas activados para {$affectedRows} usuarios con asistencias confirmadas";
                    break;

                case 'deactivate':
                    // ✅ Desactivar diplomas para todos los usuarios (sin restricción) 
                    $affectedRows = User::where('is_downloaded', true)->update(['is_downloaded' => false]);
                    $message = "Diplomas desactivados para {$affectedRows} usuarios";
                    break;

                case 'toggle_all':

                    // 1. Desactivar todos los diplomas actualmente activos 
                    $activeToInactive = User::where('is_downloaded', true)->update(['is_downloaded' => false]);

                    // 2. Activar SOLO para usuarios con asistencias confirmadas que no tenían diploma activo 
                    $inactiveToActive = User::whereIn('id', $usersWithConfirmedAttendances)
                        ->where('is_downloaded', false)
                        ->update(['is_downloaded' => true]);

                    $affectedRows = $activeToInactive + $inactiveToActive;
                    $message = "Estados de diplomas invertidos para {$affectedRows} usuarios. Solo se activaron para usuarios con asistencias confirmadas.";
                    break;
            }

            //  Recalcular estadísticas actualizadas 
            $totalUsers = User::count();
            $activeUsers = User::where('status', true)->count();
            $inactiveUsers = User::where('status', false)->count();
            $downloadedDiplomas = User::where('is_downloaded', true)->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'affected_rows' => $affectedRows, // Número de registros modificados 
                'stats' => [ // Estadísticas actualizadas del sistema 
                    'total' => $totalUsers,
                    'active' => $activeUsers,
                    'inactive' => $inactiveUsers,
                    'downloaded' => $downloadedDiplomas
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al ejecutar la acción masiva: ' . $e->getMessage()
            ], 500);
        }
    }

     /**
     * Cambia el estado de descarga de diploma SIN RESTRICCIONES para administradores
     * - Permite activar/desactivar diplomas sin verificar asistencias
     * - Solo disponible para usuarios administradores
     * - Compatible con el sistema existente
     */
    public function toggleDiplomaAdmin(Request $request, $uuid)
    {
        try {
            // Verificar que el usuario actual es administrador
            if (!auth()->user()->is_admin) {
                return response()->json([
                    'success' => false,
                    'message' => 'No tienes permisos para realizar esta acción'
                ], 403);
            }

            $user = User::where('uuid', $uuid)->firstOrFail();

            // Obtener el valor deseado del request o hacer toggle
            $desiredValue = $request->has('value') ? $request->value : !$user->is_downloaded;

            // ACTUALIZAR ESTADO DE DESCARGA SIN RESTRICCIONES
            $user->is_downloaded = $desiredValue;
            $user->save();

            // Calcular TODAS las estadísticas
            $totalUsers = User::count();
            $activeUsers = User::where('status', true)->count();
            $inactiveUsers = User::where('status', false)->count();
            $downloadedDiplomas = User::where('is_downloaded', true)->count();

            return response()->json([
                'success' => true,
                'message' => $user->is_downloaded ?
                    'Diploma marcado como descargado (modo administrador)' :
                    'Descarga de diploma desmarcada (modo administrador)',
                'is_downloaded' => $user->is_downloaded,
                'admin_override' => true, // Indicar que fue una acción de administrador
                'stats' => [
                    'total' => $totalUsers,
                    'active' => $activeUsers,
                    'inactive' => $inactiveUsers,
                    'downloaded' => $downloadedDiplomas
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado del diploma: ' . $e->getMessage(),
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }


}