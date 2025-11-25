<?php

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Profile\UserProfileResource;
use App\Http\Requests\Api\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;

use function Laravel\Prompts\select;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            $user = User::with('modality')->where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'user' => new UserProfileResource($user)
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Usuario no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado',
                'error'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, string $uuid)
    {
        /* return response()->json($request);  */
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            
            // Actualizar password solo si se envió
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            // Procesar imagen base64 si existe
            if ($request->has('photo') && $request->photo) {
                $user->photo = $this->saveBase64Image($request->photo, $user->uuid);
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Perfil actualizado correctamente',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado',
                'error'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Guardar imagen base64 en el filesystem
     */
    private function saveBase64Image(string $base64Image, string $uuid)
    {
        try {
            // Obtener el usuario y su foto actual
            $user = User::where('uuid', $uuid)->firstOrFail();

            $photoPath = $user->getRawOriginal('photo'); // Ruta actual de la foto

            // Obtener datos y decodificar
            $base64Data = substr($base64Image, strpos($base64Image, ',') + 1);
            $imageData = base64_decode($base64Data);

            if ($imageData === false) {
                return null;
            }

            // Generar nombre único organizado por usuario
            $fileName = 'profiles/' . Str::uuid() . '.jpg';

            // Guardar nueva imagen
            Storage::disk('local')->put($fileName, $imageData);

            // Eliminar imagen anterior si existe
            if ($photoPath && Storage::disk('local')->exists($photoPath)) {
                Storage::disk('local')->delete($photoPath);
            }

            return $fileName;
        } catch (\Exception $e) {
            Log::error('Error al guardar imagen base64: ' . $e->getMessage());
            return null;
        }
    }
}
