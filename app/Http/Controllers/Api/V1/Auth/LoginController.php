<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\LoginResource;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        try {
         
         $user = User::with(['setting' => function($q) {
            $q->where('is_active', true);
         },
         'modality'])->where('email', '=', $request->email)->where('status', true)->firstOrFail();

         // Verificar si el usuario existe y la contraseña es correcta
         if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'errors' => ['credentials' => ['Correo o contraseña inválidos']],
                    'success' => false,
                ], 422);
            }

         // Verificar si la cuenta está desactivada
         if (!$user->status) {
                return response()->json([
                    'message' => 'Cuenta desactivada',
                    'errors' => ['account' => ['Su cuenta ha sido desactivada']],
                    'success' => false,
                ], 403);
            }

           // Revocar todos los tokens existentes del usuario (una sola sesión)
            $this->revokeAllTokens($user);

            // Crear nuevo token
            $token = $user->createToken($user->uuid)->plainTextToken;

            return response()->json([
                'user' => new LoginResource($user),
                'token' => $token,
                'token_type' => 'Bearer',
                'message' => 'Sesión iniciada correctamente.'
            ], 200);
            
                     
         } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Si el usuario o el tenant no cumplen las condiciones, devolver el error correspondiente
            return response()->json([
                'message' => 'Credenciales inválidas.',
                'errors' => ['status' => ['El correo no existe o la cuenta está inactiva.']],
                'success' => false,
            ], 403);
            
        } catch (\Exception $e) {
            // Captura cualquier otro error inesperado
            return response()->json([
                'message' => 'Error interno del servidor',
                'error' => config('app.debug') ? $e->getMessage() : 'Contacte al administrador',
                'success' => false,
            ], 500);
        }

     }

    /**
     * Método PRIVADO para revocar todos los tokens de un usuario
     * Este método solo puede ser llamado internamente desde el controlador
     */
    private function revokeAllTokens(User $user)
    {
        $user->tokens()->delete();
    }
}
