<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
   public function logout(Request $request)
    {
        try {
            $user = auth()->user();

           // Eliminar los tokens del usuario
            $user->tokens()->delete();

            // Respuesta exitosa
            return response()->json([
                'message' => 'Sesión cerrada exitosamente.',
                'success' => true,
            ], 200);
            
        } catch (\Exception $e) {
            Log::error('Error en AuthController.logout', ['error' => $e->getMessage()]);
    
            return response()->json([
                'message' => 'Ocurrió un error al cerrar la sesión.',
                'success' => false,
            ], 500);
        }
    }
}
