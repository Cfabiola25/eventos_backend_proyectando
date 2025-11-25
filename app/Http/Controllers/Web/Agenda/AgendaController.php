<?php

namespace App\Http\Controllers\Web\Agenda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use Carbon\Carbon;
use Exception;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $agendas = Agenda::all();

            return view('agenda.index', compact('agendas'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las temas',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * editar
     */
    public function edit(string $uuid)
    {
        try {
            $agenda = Agenda::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'data' => [
                    'title' => $agenda->title,
                    'description' => $agenda->description,
                    'start_date' => $agenda->start_date->format('Y-m-d'),
                    'end_date' => $agenda->end_date->format('Y-m-d'),
                    'start_time' => \Carbon\Carbon::parse($agenda->start_time)->format('H:i'),
                    'end_time' => \Carbon\Carbon::parse($agenda->end_time)->format('H:i'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Agenda no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        try {
            $agenda = Agenda::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'description' => 'nullable|string',
            ]);

            $agenda->update($validated);

            // Recargar la agenda con los datos actualizados
            $agenda->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Agenda actualizada exitosamente.',
                'data' => $agenda // Devuelve los datos actualizados
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la agenda: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $agenda = Agenda::where('uuid', $uuid)->firstOrFail();
            $agenda->delete();

            return response()->json([
                'success' => true,
                'message' => 'Agenda eliminada exitosamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la agenda: ' . $e->getMessage()
            ], 500);
        }
    }
}
