<?php

namespace App\Http\Controllers\Api\V1\Theme;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Event;
use Carbon\Carbon;
use Exception;

class ThemeController extends Controller
{
    /**
     * consultando todos los temas
     */
    public function index(Request $request)
    {
        /* $themes = Theme::with(['events' => function ($query) {
            $query->with(['schedules'])->orderBy('created_at', 'DESC');
        }])->get(); */

   /*      $themes = Theme::with(['events' => function ($query) {
            $query->whereHas('schedules', function ($scheduleQuery) {
                $scheduleQuery->whereRaw('schedules.start_date = (
                    SELECT themes.start_date 
                    FROM themes 
                    INNER JOIN event_theme ON themes.id = event_theme.theme_id 
                    WHERE event_theme.event_id = event_schedule_location.event_id 
                    LIMIT 1
                )');
            })
            ->with(['schedules' => function ($scheduleQuery) {
                $scheduleQuery->whereRaw('schedules.start_date = (
                    SELECT themes.start_date 
                    FROM themes 
                    INNER JOIN event_theme ON themes.id = event_theme.theme_id 
                    WHERE event_theme.event_id = event_schedule_location.event_id 
                    LIMIT 1
                )');
            }])
            ->orderBy('created_at', 'DESC');
        }])->get(); */

         /* $themes = Theme::with(['events' => function ($query) {
            $query->where('modality_id', 1) // Filtrar por modalidad_id = 1 (Presencial)
            ->where('is_active', true) // Filtrar por eventos activos
            ->whereHas('schedules', function ($scheduleQuery) {
                $scheduleQuery->where('start_date', function ($subQuery) {
                    $subQuery->select('themes.start_date')
                            ->from('themes')
                            ->join('event_theme', 'themes.id', '=', 'event_theme.theme_id')
                            ->whereColumn('event_theme.event_id', 'event_schedule_location.event_id')
                            ->limit(1);
                });
            })
            ->with(['schedules' => function ($scheduleQuery) {
                $scheduleQuery->where('start_date', function ($subQuery) {
                    $subQuery->select('themes.start_date')
                            ->from('themes')
                            ->join('event_theme', 'themes.id', '=', 'event_theme.theme_id')
                            ->whereColumn('event_theme.event_id', 'event_schedule_location.event_id')
                            ->limit(1);
                });
            }])
            ->orderBy('created_at', 'DESC');
        }])->get(); */

       /*  $themes = Theme::with(['events' => function ($query) use ($request) {
            $query->where('modality_id', 1) // Filtrar por modalidad_id = 1 (Presencial)
                ->where('is_active', true) // Filtrar por eventos activos
                ->whereHas('schedules', function ($scheduleQuery) use ($request) {
                    // Aplicar filtro de fecha solo si existe en el request
                    if ($request->filled('start_date')) {
                        $scheduleQuery->whereDate('start_date', $request->start_date);
                    }
                    
                    $scheduleQuery->where('start_date', '=', function ($subQuery) {
                        $subQuery->select('themes.start_date')
                            ->from('themes')
                            ->join('event_theme', 'themes.id', '=', 'event_theme.theme_id')
                            ->whereColumn('event_theme.event_id', 'event_schedule_location.event_id')
                            ->limit(1);
                    });
                })
                ->with([
            'schedules' => function ($scheduleQuery) use ($request) {
                // Aplicar filtro de fecha solo si existe en el request
                if ($request->filled('start_date')) {
                    $scheduleQuery->whereDate('start_date', $request->start_date);
                }
                
                $scheduleQuery->where('start_date', '=', function ($subQuery) {
                    $subQuery->select('themes.start_date')
                        ->from('themes')
                        ->join('event_theme', 'themes.id', '=', 'event_theme.theme_id')
                        ->whereColumn('event_theme.event_id', 'event_schedule_location.event_id')
                        ->limit(1);
                });
            },
            'speakers' // Relación con speakers
        ])
        ->orderBy('created_at', 'DESC');
        }])->get();
 */

        $themes = Theme::with(['events' => function ($query) use ($request) {
            $query->where('modality_id', 1) // Filtrar por modalidad_id = 1 (Presencial)
                ->where('is_active', true) // Filtrar por eventos activos
                ->whereHas('categories', function ($categoryQuery) {
                    $categoryQuery->where('name', 'Conferencias'); // Filtrar solo Conferencias
                })
                ->whereHas('schedules', function ($scheduleQuery) use ($request) {
                    // Aplicar filtro de fecha solo si existe en el request
                    if ($request->filled('start_date')) {
                        $scheduleQuery->whereDate('start_date', $request->start_date);
                    }
                    
                    $scheduleQuery->where('start_date', '=', function ($subQuery) {
                        $subQuery->select('themes.start_date')
                            ->from('themes')
                            ->join('event_theme', 'themes.id', '=', 'event_theme.theme_id')
                            ->whereColumn('event_theme.event_id', 'event_schedule_location.event_id')
                            ->limit(1);
                    });
                })
                ->with([
                    'schedules' => function ($scheduleQuery) use ($request) {
                        // Aplicar filtro de fecha solo si existe en el request
                        if ($request->filled('start_date')) {
                            $scheduleQuery->whereDate('start_date', $request->start_date);
                        }
                        
                        $scheduleQuery->where('start_date', '=', function ($subQuery) {
                            $subQuery->select('themes.start_date')
                                ->from('themes')
                                ->join('event_theme', 'themes.id', '=', 'event_theme.theme_id')
                                ->whereColumn('event_theme.event_id', 'event_schedule_location.event_id')
                                ->limit(1);
                        });
                    },
                    'speakers', // Relación con speakers
                    'categories' // Relación con categories para mostrarlas en la respuesta
                ])
                ->orderBy('created_at', 'DESC');
        }])->get();
                

        return response()->json($themes, 200);
    }
}
