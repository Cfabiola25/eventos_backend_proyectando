<?php

namespace App\Http\Controllers\Api\V1\Event;

use App\Http\Resources\Api\Event\CalendarResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventCalendarController extends Controller
{
  /**
   * Funcion para obtener todos los eventos activos con sus modalidades y horarios
   */
  public function index()
  {
    
    $events = Event::with(['modality', 'schedules'])->where('is_active', true)->get();
    return response()->json([
            'success' => true,
            'events' => CalendarResource::collection($events),
        ], 200);   
  }
}
