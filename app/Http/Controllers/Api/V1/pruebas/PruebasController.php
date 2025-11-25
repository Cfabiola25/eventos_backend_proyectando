<?php

namespace App\Http\Controllers\Api\V1\pruebas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PruebasController extends Controller
{
    public function index()
    {
        $user = User::where('kit_confirmed', true)->count();
        return response()->json($user);
    }
}
