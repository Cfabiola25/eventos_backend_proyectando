<?php

namespace App\Http\Controllers\Api\V1\Certificate;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\User;

class CertificateDownloadController extends Controller
{
    public function download($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            
            // Generar el PDF
            $pdf = PDF::loadView('diploma.index', [
                'user' => $user
            ]);
            
            $filename = "certificate-{$user->first_name}-{$user->last_name}.pdf";
            
            // ⭐ OPCIÓN 1: Devolver el PDF como stream (RECOMENDADO para API)
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
            
            // ⭐ OPCIÓN 2: Devolver como base64 en JSON
            // return response()->json([
            //     'success' => true,
            //     'data' => base64_encode($pdf->output()),
            //     'filename' => $filename
            // ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener el certificado',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }

     public function getDownloadStatus($uuid)
    {
        try {
            $user = User::where('uuid', $uuid)->select('uuid', 'is_downloaded')->firstOrFail();

            return response()->json([
                'status' => $user->is_downloaded
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el estado de descarga',
                'error' => config('app.debug') ? $e->getMessage() : 'Error interno del servidor'
            ], 500);
        }
    }
}
// Toco descargar el certificad