<?php

namespace App\Http\Controllers\Web\Program;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalPrograms = Program::count();
        $activePrograms = Program::where('is_active', true)->count();
        $inactivePrograms = Program::where('is_active', false)->count();
        
        $programs = Program::orderBy('created_at', 'desc')->paginate(10);
        $search = '';

        return view('programs.index', compact('programs', 'totalPrograms', 'activePrograms', 'inactivePrograms', 'search'));
    }

    /**
     * Búsqueda AJAX de programas
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $query = Program::orderBy('created_at', 'desc');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('uuid', 'LIKE', "%{$search}%");
            });
        }

        $programs = $query->paginate(10);
        $totalPrograms = Program::count();
        $activePrograms = Program::where('is_active', true)->count();
        $inactivePrograms = Program::where('is_active', false)->count();

        $html = view('programs.components.table', compact('programs'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $programs->total(),
            'search' => $search,
            'stats' => [
                'total' => $totalPrograms,
                'active' => $activePrograms,
                'inactive' => $inactivePrograms
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
                'name' => 'required|string|max:255|unique:programs,name',
                'color' => 'required|string|max:7',
                'description' => 'nullable|string|max:500',
                'is_active' => 'required|boolean',
            ], [
                'name.required' => 'El nombre del programa es obligatorio',
                'name.unique' => 'Ya existe un programa con este nombre',
                'color.required' => 'El color es obligatorio',
                'is_active.required' => 'El estado es obligatorio',
            ]);

            Program::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Programa creado correctamente'
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
                'message' => 'Error al crear el programa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $program = Program::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'program' => [
                    'uuid' => $program->uuid,
                    'name' => $program->name,
                    'color' => $program->color,
                    'description' => $program->description,
                    'is_active' => $program->is_active,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Programa no encontrado: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $program = Program::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:programs,name,' . $program->id,
                'color' => 'required|string|max:7',
                'description' => 'nullable|string|max:500',
                'is_active' => 'required|boolean',
            ], [
                'name.required' => 'El nombre del programa es obligatorio',
                'name.unique' => 'Ya existe un programa con este nombre',
                'color.required' => 'El color es obligatorio',
                'is_active.required' => 'El estado es obligatorio',
            ]);

            $program->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Programa actualizado correctamente'
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
                'message' => 'Error al actualizar el programa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $program = Program::where('uuid', $uuid)->firstOrFail();
            $program->delete();

            return response()->json([
                'success' => true,
                'message' => 'Programa eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el programa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle program status
     */
    public function toggleStatus($uuid)
    {
        try {
            $program = Program::where('uuid', $uuid)->firstOrFail();
            $program->update(['is_active' => !$program->is_active]);

            $status = $program->is_active ? 'activado' : 'desactivado';

            return response()->json([
                'success' => true,
                'message' => "Programa {$status} correctamente"
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar el estado: ' . $e->getMessage()
            ], 500);
        }
    }
}
