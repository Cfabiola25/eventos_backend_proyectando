<?php

namespace App\Http\Controllers\Web\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todas las categorías para el total
        $totalCategories = Category::count();
        $activeCategories = Category::where('is_active', true)->count();
        $inactiveCategories = Category::where('is_active', false)->count();

        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        $search = '';

        return view('category.index', compact('categories', 'totalCategories', 'activeCategories', 'inactiveCategories', 'search'));
    }

    /**
     * Búsqueda AJAX de categorías
     */
    public function search(Request $request)
    {
        try {
            $search = $request->get('search', '');
            $page = $request->get('page', 1);

            // Query base
            $query = Category::orderBy('created_at', 'desc');

            // Aplicar búsqueda si existe
            if (!empty($search)) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                });
            }

            // Paginación
            $categories = $query->paginate(10);

            // Calcular estadísticas actualizadas
            $totalCategories = Category::count();
            $activeCategories = Category::where('is_active', true)->count();
            $inactiveCategories = Category::where('is_active', false)->count();

            // Solo retornar HTML de la tabla, no de las cards
            $tableHtml = view('category.components.table', compact('categories'))->render();
            
            return response()->json([
                'success' => true,
                'table_html' => $tableHtml,
                'stats' => [
                    'totalCategories' => $totalCategories,
                    'activeCategories' => $activeCategories,
                    'inactiveCategories' => $inactiveCategories
                ],
                'total' => $categories->total(),
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
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string|max:500',
                'is_active' => 'required|boolean',
            ]);

            $validated['uuid'] = Str::uuid();

            Category::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Categoría creada correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $category
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
                'description' => 'nullable|string|max:500',
                'is_active' => 'required|boolean',
            ]);

            $category->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Categoría actualizada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $category = Category::where('uuid', $uuid)->firstOrFail();
            $category->delete(); // Soft delete

            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la categoría: ' . $e->getMessage()
            ], 500);
        }
    }

}