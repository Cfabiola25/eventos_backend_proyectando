<?php

namespace App\Http\Controllers\Api\V1\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
     /**
     * Display a listing of the categories with only id and name.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index()
    {
        try {
            // Obtener solo los campos id y name de las categorías activas
            $categories = Category::select('id', 'name')
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $categories,
                'message' => 'Categories retrieved successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving categories',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
