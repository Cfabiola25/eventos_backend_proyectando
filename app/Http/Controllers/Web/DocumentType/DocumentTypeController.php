<?php

namespace App\Http\Controllers\Web\DocumentType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentType;
use Illuminate\Support\Str;

class DocumentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DocumentType::orderBy('created_at', 'desc')->get();

        // Contar totales
        $totalDocumentTypes = $data->count();

        // Pasar directamente los datos
        $documentTypes = $data;

        return view('DocumentType.index', compact('documentTypes', 'totalDocumentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:document_types,name',
                'code' => 'required|string|max:10|unique:document_types,code',
            ]);

            $validated['uuid'] = Str::uuid();

            DocumentType::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de documento creado correctamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tipo de documento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $documentType = DocumentType::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => $documentType
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo de documento no encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $documentType = DocumentType::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:document_types,name,' . $documentType->id,
                'code' => 'required|string|max:10|unique:document_types,code,' . $documentType->id,
            ]);

            $documentType->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Tipo de documento actualizado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tipo de documento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $documentType = DocumentType::where('uuid', $uuid)->firstOrFail();
            $documentType->delete(); // Soft delete

            return response()->json([
                'success' => true,
                'message' => 'Tipo de documento eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tipo de documento: ' . $e->getMessage()
            ], 500);
        }
    }
}