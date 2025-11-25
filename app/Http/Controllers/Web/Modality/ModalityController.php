<?php

namespace App\Http\Controllers\Web\Modality;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modality;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ModalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalModalities = Modality::count();
        $activeModalities = Modality::where('is_active', true)->count();
        $inactiveModalities = Modality::where('is_active', false)->count();

        $modalities = Modality::orderBy('created_at', 'desc')->paginate(10);
        $search = '';

        return view('modality.index', compact('modalities', 'totalModalities', 'activeModalities', 'inactiveModalities', 'search'));
    }

    /**
     * Búsqueda AJAX de modalidades
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $query = Modality::orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }

        $modalities = $query->paginate(10);
        $totalModalities = Modality::count();
        $activeModalities = Modality::where('is_active', true)->count();
        $inactiveModalities = Modality::where('is_active', false)->count();

        $html = view('modality.components.table', compact('modalities'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $modalities->total(),
            'search' => $search,
            'stats' => [
                'total' => $totalModalities,
                'active' => $activeModalities,
                'inactive' => $inactiveModalities
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:modalitys,name',
                'is_active' => 'required|boolean',
            ], [
                'name.required' => 'El nombre de la modalidad es obligatorio',
                'name.unique' => 'Ya existe una modalidad con este nombre',
                'is_active.required' => 'El estado es obligatorio',
            ]);

            Modality::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Modalidad creada correctamente'
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la modalidad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $modality = Modality::findOrFail($id);

            return response()->json([
                'success' => true,
                'modality' => [
                    'id' => $modality->id,
                    'name' => $modality->name,
                    'is_active' => $modality->is_active,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error al editar modalidad: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Modalidad no encontrada: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $modality = Modality::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:modalitys,name,' . $id,
                'is_active' => 'required|boolean',
            ], [
                'name.required' => 'El nombre de la modalidad es obligatorio',
                'name.unique' => 'Ya existe una modalidad con este nombre',
                'is_active.required' => 'El estado es obligatorio',
            ]);

            $modality->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Modalidad actualizada correctamente'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la modalidad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($id)
    {
        try {
            $modality = Modality::findOrFail($id);
            $modality->delete();

            return response()->json([
                'success' => true,
                'message' => 'Modalidad eliminada correctamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la modalidad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle modality status
     */
    public function toggleStatus($id)
    {
        try {
            $modality = Modality::findOrFail($id);
            $modality->update(['is_active' => !$modality->is_active]);

            $status = $modality->is_active ? 'activada' : 'desactivada';

            return response()->json([
                'success' => true,
                'message' => "Modalidad {$status} correctamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado: ' . $e->getMessage()
            ], 500);
        }
    }
}
