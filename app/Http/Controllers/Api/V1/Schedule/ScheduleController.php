<?php

namespace App\Http\Controllers\Api\V1\Schedule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Horarios.
     */
    public function index()
    {
        try {
            $schedules = Schedule::with(['events', 'locations'])->get( );
            return response()->json($schedules, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve schedules'], 500);
        }
    }

}
