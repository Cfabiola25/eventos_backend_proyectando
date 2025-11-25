<?php

namespace App\Http\Controllers\Web\Qr;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class QrController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = User::where('uuid', $request->uuid)->firstOrFail();

             $qr = QrCode::size(110)
            ->errorCorrection('L')
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->generate($user->document_number); 

            return view('qr.index', compact('user', 'qr'));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error inesperado',
                'error'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
