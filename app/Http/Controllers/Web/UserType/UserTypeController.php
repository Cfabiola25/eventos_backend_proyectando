<?php

namespace App\Http\Controllers\Web\UserType;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\UserType\UserType as UserTypeResource;
use Illuminate\Http\Request;
use App\Models\UserType;
use Illuminate\Support\Str;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UserType::orderBy('created_at', 'desc')->get();
        $userTypes = UserTypeResource::collection($data);

        // Contar activos e inactivos
        $totalUserTypes = $data->count();
        $activeUserTypes = $data->where('is_active', 1)->count();
        $inactiveUserTypes = $data->where('is_active', 0)->count();

        return view('usertype.index', compact('userTypes', 'totalUserTypes', 'activeUserTypes', 'inactiveUserTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|string|max:255|unique:user_types,type',
                'description' => 'required|string|max:500',
                'is_active' => 'boolean'
            ]);

            $validated['uuid'] = Str::uuid();
            $validated['is_active'] = $request->has('is_active') ? 1 : 1; // Por defecto activo

            UserType::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de usuario creado correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $userType = UserType::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $userType
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de usuario no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $userType = UserType::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'type' => 'required|string|max:255|unique:user_types,type,' . $userType->id,
                'description' => 'required|string|max:500',
                'is_active' => 'boolean'
            ]);

            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            $userType->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de usuario actualizado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tipo de usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $userType = UserType::where('uuid', $uuid)->firstOrFail();
            $userType->delete(); // Soft delete

            return response()->json([
                'success' => true,
                'message' => 'Tipo de usuario eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle active status
     */
    public function toggleStatus($uuid)
    {
        try {
            $userType = UserType::where('uuid', $uuid)->firstOrFail();
            $userType->is_active = !$userType->is_active;
            $userType->save();

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado correctamente',
                'is_active' => $userType->is_active
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado: ' . $e->getMessage()
            ], 500);
        }
    }
}