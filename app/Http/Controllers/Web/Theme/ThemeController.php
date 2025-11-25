<?php

namespace App\Http\Controllers\Web\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Theme;
use App\Models\Agenda;
use Carbon\Carbon;
use Exception;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $themes = Theme::with('agenda')->orderBy('start_date', 'asc')->orderBy('name', 'asc')->get();
            $agendas = Agenda::orderBy('start_date', 'asc')->get();

            return view('theme.index', compact('themes', 'agendas'));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los temas',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * funcion guardar
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'description' => 'nullable|string',
                'agenda_id' => 'required|exists:agendas,id'
            ]);

            $validated['uuid'] = Str::uuid();

            $theme = new Theme();
            $theme->uuid = Str::uuid();
            $theme->name = $request->name;
            $theme->start_date = $request->start_date;
            $theme->description = $request->description;
            $theme->agenda_id = $request->agenda_id;
            $theme->is_active = true;
            $theme->save();

            // Cargar la relación de agenda
            $theme->load('agenda');

            return response()->json([
                'success' => true,
                'message' => 'Tema creado exitosamente.',
                'theme' => [
                    'uuid' => $theme->uuid,
                    'name' => $theme->name,
                    'start_date' => $theme->start_date,
                    'description' => $theme->description,
                    'agenda_id' => $theme->agenda_id,
                    'agenda_title' => $theme->agenda ? $theme->agenda->title : null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el tema: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        try {
            $theme = Theme::with(['agenda', 'events'])->where('uuid', $uuid)->firstOrFail();
            return view('themes.show', compact('theme'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tema no encontrado: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        try {
            $theme = Theme::with('agenda')->where('uuid', $uuid)->firstOrFail();

            // CORRECCIÓN: Verificar si es Carbon o string
            $startDate = $theme->start_date;
            if (!$startDate instanceof Carbon) {
                $startDate = Carbon::parse($startDate);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $theme->name,
                    'start_date' => $startDate->format('Y-m-d'),
                    'description' => $theme->description,
                    'agenda_id' => $theme->agenda_id,
                    'agenda_title' => $theme->agenda ? $theme->agenda->title : null // ← AGREGAR ESTA LÍNEA
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tema no encontrado: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        try {
            $theme = Theme::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'description' => 'nullable|string',
                'agenda_id' => 'nullable|exists:agendas,id'
            ]);

            // Si agenda_id está vacío, establecerlo como null
            if (empty($validated['agenda_id'])) {
                $validated['agenda_id'] = null;
            }

            $theme->update($validated);

            // Recargar el tema con los datos actualizados Y CARGAR LA RELACIÓN AGENDA
            $theme->refresh();
            $theme->load('agenda'); // ← ESTA LÍNEA ES CLAVE

            // CORRECCIÓN: Verificar si es Carbon o string
            $startDate = $theme->start_date;
            if (!$startDate instanceof Carbon) {
                $startDate = Carbon::parse($startDate);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tema actualizado exitosamente.',
                'data' => [
                    'name' => $theme->name,
                    'start_date' => $startDate->format('Y-m-d'),
                    'description' => $theme->description,
                    'agenda_id' => $theme->agenda_id,
                    'agenda_title' => $theme->agenda ? $theme->agenda->title : null // ← AGREGAR ESTA LÍNEA
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el tema: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $theme = Theme::where('uuid', $uuid)->firstOrFail();
            $theme->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tema eliminado exitosamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el tema: ' . $e->getMessage()
            ], 500);
        }
    }
}
