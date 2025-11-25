<?php

namespace App\Http\Controllers\Web\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $totalSchedules = Schedule::count();
        $upcomingSchedules = Schedule::upcoming()->count();
        $pastSchedules = Schedule::where('end_date', '<', now()->format('Y-m-d'))->count();
        $schedules = Schedule::orderBy('start_date', 'desc')->paginate(10);
        $search = '';

        return view('schedules.index', compact('schedules', 'totalSchedules', 'upcomingSchedules', 'pastSchedules', 'search'));
    }

    /**
     * Búsqueda AJAX de horarios
     */
    public function search(Request $request)
    {
        $search = $request->get('search', '');
        $query = Schedule::orderBy('start_date', 'desc');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('start_date', 'LIKE', "%{$search}%")
                    ->orWhere('end_date', 'LIKE', "%{$search}%")
                    ->orWhere('start_time', 'LIKE', "%{$search}%")
                    ->orWhere('end_time', 'LIKE', "%{$search}%");
            });
        }

        $schedules = $query->paginate(10);
        $totalSchedules = Schedule::count();
        $upcomingSchedules = Schedule::upcoming()->count();
        $pastSchedules = Schedule::where('end_date', '<', now()->format('Y-m-d'))->count();

        $html = view('schedules.components.table', compact('schedules'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total' => $schedules->total(),
            'search' => $search,
            'stats' => [
                'total' => $totalSchedules,
                'upcoming' => $upcomingSchedules,
                'past' => $pastSchedules
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
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ], [
                'start_date.required' => 'La fecha de inicio es obligatoria',
                'end_date.required' => 'La fecha de finalización es obligatoria',
                'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio',
                'start_time.required' => 'La hora de inicio es obligatoria',
                'end_time.required' => 'La hora de finalización es obligatoria',
                'end_time.after' => 'La hora de finalización debe ser posterior a la hora de inicio',
            ]);

            $validated['uuid'] = Str::uuid();
            Schedule::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Horario creado correctamente'
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
                'message' => 'Error al crear el horario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        try {
            $schedule = Schedule::where('uuid', $uuid)->firstOrFail();

            return response()->json([
                'success' => true,
                'schedule' => [
                    'uuid' => $schedule->uuid,
                    'start_date' => $schedule->start_date instanceof \Carbon\Carbon
                        ? $schedule->start_date->format('Y-m-d')
                        : $schedule->start_date,
                    'end_date' => $schedule->end_date instanceof \Carbon\Carbon
                        ? $schedule->end_date->format('Y-m-d')
                        : $schedule->end_date,
                    'start_time' => is_string($schedule->start_time)
                        ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i')
                        : $schedule->start_time->format('H:i'),
                    'end_time' => is_string($schedule->end_time)
                        ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i')
                        : $schedule->end_time->format('H:i'),
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error al editar horario: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Horario no encontrado: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {
            $schedule = Schedule::where('uuid', $uuid)->firstOrFail();

            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ], [
                'start_date.required' => 'La fecha de inicio es obligatoria',
                'end_date.required' => 'La fecha de finalización es obligatoria',
                'end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio',
                'start_time.required' => 'La hora de inicio es obligatoria',
                'end_time.required' => 'La hora de finalización es obligatoria',
                'end_time.after' => 'La hora de finalización debe ser posterior a la hora de inicio',
            ]);

            $schedule->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Horario actualizado correctamente'
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
                'message' => 'Error al actualizar el horario: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($uuid)
    {
        try {
            $schedule = Schedule::where('uuid', $uuid)->firstOrFail();
            $schedule->delete();

            return response()->json([
                'success' => true,
                'message' => 'Horario eliminado correctamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el horario: ' . $e->getMessage()
            ], 500);
        }
    }
}