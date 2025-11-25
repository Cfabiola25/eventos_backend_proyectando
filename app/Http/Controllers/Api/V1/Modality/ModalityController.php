<?php

namespace App\Http\Controllers\Api\V1\Modality;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modality;
use Exception;

class ModalityController extends Controller
{
     /**
     * Display a listing of the modalities with only id and name.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index()
    {
        try {
            // Obtener solo los campos id y name de las modalidades activas
            $modalities = Modality::select('id', 'name')
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $modalities,
                'message' => 'Modalities retrieved successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving modalities',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
