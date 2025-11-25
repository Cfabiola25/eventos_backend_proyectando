<?php

namespace App\Http\Controllers\Api\V1\Theme;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Theme\ThemeEventResource;
use Illuminate\Http\Request;
use App\Models\Theme;
use Exception;

class ThemeController extends Controller
{
    /**
     * consultando todos los temas
     */
    public function index(Request $request)
    {
        try {
            
          $themes = Theme::with(['events' => function ($query) use ($request) {
            $query->where('is_active', true)
                ->with(['speakers','schedules', 'modality', 'categories'])
                ->when($request->modality_id, function ($q) use ($request) {
                    $q->where('modality_id', $request->modality_id);
                })
                ->when($request->category_id, function ($q) use ($request) {
                    $q->whereHas('categories', function ($categoryQuery) use ($request) {
                        $categoryQuery->where('categories.id', $request->category_id);
                    });
                })
                ->orderBy('created_at', 'DESC');
        }])->get();

         return response()->json(ThemeEventResource::collection($themes), 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid parameters', 'message' => $e->getMessage()], 400);
        }
        
    }
}
