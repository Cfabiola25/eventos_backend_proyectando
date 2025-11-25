<?php

namespace App\Http\Controllers\Api\V1\Program;
use Exception;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Program\ProgramIndexResource;
use App\Http\Requests\Api\Program\AcademiProgramIndexRequest;

class ProgramController extends Controller
{
    public function index(AcademiProgramIndexRequest $request){
        try {

          // Cargar relación de eventos con filtros condicionales
           $programs = Program::with(['events' => function($q) use ($request) {
                $q->when($request->filled(['start_date', 'end_date']), function($q) use ($request) {
                    // Filtrar eventos que tengan horarios en el rango especificado
                    $q->whereHas('schedules', function($subQuery) use ($request) {
                    $subQuery->where('start_date', '>=', $request->start_date)
                    ->where('end_date', '<=', $request->end_date);
                    });
                })  // Cargar relaciones anidadas de cada evento filtrado
                ->with(['modality', 'locations', 'schedules' => function($q) use ($request) {
                    $q->when($request->filled(['start_date', 'end_date']), function($q) use ($request) {
                    // Filtrar horarios que estén dentro del rango especificado
                    $q->where('start_date', '>=', $request->start_date)
                        ->where('end_date', '<=', $request->end_date);
                    });
                  }
                ]);
             }
            ])
            ->where('is_active', true) // Filtrar solo programas activos
            
            // Aplicar filtro de fechas solo si se proporcionan ambas fechas
            ->when($request->filled(['start_date', 'end_date']), function($q) use ($request) {
                $q->whereHas('events.schedules', function($q) use ($request) {
                    $q->where('start_date', '>=', $request->start_date)
                    ->where('end_date', '<=', $request->end_date);
                });
            })->get();

            //  return $programs; 

            return response()->json([
                'success' => true,
                'programs'    => ProgramIndexResource::collection($programs),
            ], 200);

        } catch (Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los programas académicos.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
