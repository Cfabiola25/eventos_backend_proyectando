<?php

namespace App\Http\Controllers\Api\V1\Agenda;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Agenda\AgendaResource;
use Illuminate\Http\Request;
use App\Models\Agenda;
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
            return response()->json([
                'success' => true,
                'data' => AgendaResource::collection($agendas),
                'message' => 'Agendas obtenidas exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las agendas',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }
}
