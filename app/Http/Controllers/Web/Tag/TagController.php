<?php

namespace App\Http\Controllers\Web\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener todos los tags para el total
        $totalTags = Tag::count();

        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);

        $search = '';

        return view('tag.index', compact('tags', 'totalTags', 'search'));
    }

    /**
     * Búsqueda AJAX de etiquetas
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $page = $request->get('page', 1);

        // Query base
        $query = Tag::orderBy('created_at', 'desc');

        // Aplicar búsqueda si existe
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('color', 'LIKE', "%{$search}%");
            });
        }

        // Paginación
        $tags = $query->paginate(10);

        // Retornar HTML de la tabla
        $html = view('tag.components.table', compact('tags'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $tags->total(),
            'search' => $search
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:tags,name',
                'color' => 'required|string|max:7', // Formato hexadecimal #RRGGBB
                'description' => 'nullable|string|max:500',
            ]);

            $validated['uuid'] = Str::uuid();
            $validated['name'] = Tag::formatTagName($validated['name']);

            if (isset($validated['description'])) {
                $validated['description'] = Tag::formatTagDescription($validated['description']);
            }

            Tag::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Etiqueta creada correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la etiqueta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $tag = Tag::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $tag
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Etiqueta no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $tag = Tag::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
                'color' => 'required|string|max:7',
                'description' => 'nullable|string|max:500',
            ]);

            $validated['name'] = Tag::formatTagName($validated['name']);

            if (isset($validated['description'])) {
                $validated['description'] = Tag::formatTagDescription($validated['description']);
            }

            $tag->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Etiqueta actualizada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la etiqueta: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $tag = Tag::where('uuid', $uuid)->firstOrFail();
            $tag->delete(); // Soft delete

            return response()->json([
                'success' => true,
                'message' => 'Etiqueta eliminada correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la etiqueta: ' . $e->getMessage()
            ], 500);
        }
    }
}