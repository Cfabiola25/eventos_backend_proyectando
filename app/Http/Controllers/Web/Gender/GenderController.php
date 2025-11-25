<?php

namespace App\Http\Controllers\Web\Gender;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener estadísticas
        $total = Gender::count();
        $activos = Gender::where('is_active', true)->count();
        $inactivos = Gender::where('is_active', false)->count();

        $genders = Gender::orderBy('created_at', 'desc')->paginate(10);

        $search = '';

        return view('gender.index', compact('genders', 'total', 'activos', 'inactivos', 'search'));
    }

    /**
     * Búsqueda AJAX de géneros
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('search', '');
            $page = $request->get('page', 1);

            // Query base
            $query = Gender::orderBy('created_at', 'desc');

            // Aplicar búsqueda si existe
            if (!empty($search)) {
                $query->where('name', 'LIKE', "%{$search}%");
            }

            // Paginación
            $genders = $query->paginate(10);

            // Calcular estadísticas actualizadas
            $total = Gender::count();
            $activos = Gender::where('is_active', true)->count();
            $inactivos = Gender::where('is_active', false)->count();

            // Solo retornar HTML de la tabla, no de las cards
            $tableHtml = view('gender.components.table', compact('genders'))->render();
            
            return response()->json([
                'success' => true,
                'table_html' => $tableHtml,
                'stats' => [
                    'total' => $total,
                    'activos' => $activos,
                    'inactivos' => $inactivos
                ],
                'total' => $genders->total(),
                'search' => $search
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en la búsqueda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genders,name',
                'is_active' => 'required|boolean',
            ]);

            $validated['uuid'] = Str::uuid();

            Gender::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Género creado correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el género: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $gender = Gender::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $gender
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Género no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $gender = Gender::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:genders,name,' . $gender->id,
                'is_active' => 'required|boolean',
            ]);

            $gender->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Género actualizado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el género: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        try {
            $gender = Gender::where('uuid', $uuid)->firstOrFail();
            $gender->delete(); // Delete permanente

            return response()->json([
                'success' => true,
                'message' => 'Género eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el género: ' . $e->getMessage()
            ], 500);
        }
    }
}