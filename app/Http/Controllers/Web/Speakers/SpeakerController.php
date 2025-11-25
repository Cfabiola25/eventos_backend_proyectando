<?php

namespace App\Http\Controllers\Web\Speakers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalSpeakers = Speaker::count();
        $activeSpeakers = Speaker::where('is_active', true)->count();
        $inactiveSpeakers = Speaker::where('is_active', false)->count();
        $speakers = Speaker::orderBy('created_at', 'desc')->paginate(10);
        $search = '';

        return view('speakers.index', compact('speakers', 'totalSpeakers', 'activeSpeakers', 'inactiveSpeakers', 'search'));
    }

    /**
     * Búsqueda AJAX de ponentes
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $query = Speaker::orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('profession', 'LIKE', "%{$search}%")
                    ->orWhere('bio', 'LIKE', "%{$search}%");
            });
        }

        $speakers = $query->paginate(10);
        $totalSpeakers = Speaker::count();
        $activeSpeakers = Speaker::where('is_active', true)->count();
        $inactiveSpeakers = Speaker::where('is_active', false)->count();
        $html = view('speakers.components.table', compact('speakers'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $speakers->total(),
            'search' => $search,
            'stats' => [
                'total' => $totalSpeakers,
                'active' => $activeSpeakers,
                'inactive' => $inactiveSpeakers
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('speakers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('📥 INICIANDO STORE - Con base64');

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'profession' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'skills' => 'nullable|string',
                'website' => 'nullable|url|max:500',
                'social_links' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'photo_base64' => 'nullable|string',
            ]);

            // Procesar skills
            if (isset($validated['skills'])) {
                $skillsArray = array_map('trim', explode(',', $validated['skills']));
                $validated['skills'] = json_encode($skillsArray);
            }

            // Procesar social_links
            if (isset($validated['social_links']) && !empty($validated['social_links'])) {
                $decoded = json_decode($validated['social_links'], true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $validated['social_links'] = null;
                }
            }

            // 🆕 GUARDAR FOTO BASE64
            if ($request->has('photo_base64') && !empty($request->photo_base64)) {
                $photoPath = $this->saveBase64Image($request->photo_base64);
                if ($photoPath) {
                    $validated['photo'] = $photoPath;
                }
            }

            $validated['is_active'] = $validated['is_active'] ?? 1;

            $speaker = Speaker::create($validated);

            return redirect()->route('speakers.index')->with('success', 'Ponente creado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al crear el ponente: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $speaker = Speaker::findOrFail($id);
            return view('speakers.edit', compact('speaker'));
        } catch (\Exception $e) {
            return redirect()->route('speakers.index')->with('error', 'Ponente no encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $speaker = Speaker::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'profession' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'skills' => 'nullable|string',
                'website' => 'nullable|url|max:500',
                'social_links' => 'nullable|string',
                'is_active' => 'nullable|boolean',
                'photo_base64' => 'nullable|string',
            ]);

            // Procesar skills
            if (isset($validated['skills'])) {
                $skillsArray = array_map('trim', explode(',', $validated['skills']));
                $validated['skills'] = json_encode($skillsArray);
            }

            // Procesar social_links
            if (isset($validated['social_links']) && !empty($validated['social_links'])) {
                $decoded = json_decode($validated['social_links'], true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $validated['social_links'] = null;
                }
            }

            // 🆕 CORRECCIÓN: Pasar el speaker como parámetro
            if ($request->has('photo_base64') && !empty($request->photo_base64)) {
                $photoPath = $this->updateBase64Image($request->photo_base64, $speaker); // 🆕 Agregar $speaker
                if ($photoPath) {
                    $validated['photo'] = $photoPath;
                }
            }

            $validated['is_active'] = $validated['is_active'] ?? 0;
            $speaker->update($validated);

            return redirect()->route('speakers.index')->with('success', 'Ponente actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el ponente: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        try {
            $speaker = Speaker::findOrFail($id);
            $photoPath = $speaker->getRawOriginal('photo');

            if ($photoPath && Storage::disk('local')->exists($photoPath)) {
                Storage::disk('local')->delete($photoPath);
            }

            $speaker->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ponente eliminado correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el ponente: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle active status
     */
    public function toggleStatus($id)
    {
        try {
            $speaker = Speaker::findOrFail($id);
            $speaker->is_active = !$speaker->is_active;
            $speaker->save();

            $totalSpeakers = Speaker::count();
            $activeSpeakers = Speaker::where('is_active', true)->count();
            $inactiveSpeakers = Speaker::where('is_active', false)->count();

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente',
                'is_active' => $speaker->is_active,
                'stats' => [
                    'total' => $totalSpeakers,
                    'active' => $activeSpeakers,
                    'inactive' => $inactiveSpeakers
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    // ==================================================
    // MÉTODOS PRIVADOS - MANEJO DE IMÁGENES
    // ==================================================

    /**
     * Guarda una imagen base64 en el sistema de archivos
     */
    private function saveBase64Image(string $base64Image)
    {
        try {

            if (empty($base64Image)) {
                return null;
            }

            $base64Data = substr($base64Image, strpos($base64Image, ',') + 1);
            $imageData = base64_decode($base64Data);

            if ($imageData === false || empty($imageData)) {
                return null;
            }

            $fileName = 'speakers/' . Str::uuid() . '.jpg';

            Storage::disk('local')->put($fileName, $imageData);

            if (!Storage::disk('local')->exists($fileName)) {
                return null;
            }

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Actualiza una imagen base64 y elimina la anterior
     */
    private function updateBase64Image(string $base64Image, Speaker $speaker)
    {
        try {

            // Obtener la foto actual del speaker
            $currentPhotoPath = $speaker->getRawOriginal('photo');

            // Guardar nueva imagen usando la función existente
            $newPhotoPath = $this->saveBase64Image($base64Image);

            if ($newPhotoPath) {
                // Eliminar imagen anterior si existe
                if ($currentPhotoPath && Storage::disk('local')->exists($currentPhotoPath)) {
                    Storage::disk('local')->delete($currentPhotoPath);
                }

                return $newPhotoPath;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}