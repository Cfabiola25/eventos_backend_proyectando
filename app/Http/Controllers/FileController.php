<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
   /**
     * Obtener un archivo.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getFile(Request $request)
    {
        // Validar que se proporcione el parámetro path
        $request->validate([
            'path' => 'required|string'
        ]);

        // Decodificar la URL para manejar caracteres como %2F
        $decodedPath = urldecode($request->path);
        
        // Limpiar y normalizar el path
        $cleanPath = $this->sanitizePath($decodedPath);
        
        // Construir la ruta completa del archivo
        $fullPath = storage_path("app/" . $cleanPath);
        
        // Verificar que el archivo existe y está dentro del directorio permitido
        if (!$this->isValidFile($fullPath, $cleanPath)) {
            return response()->json([
                'error' => 'Archivo no encontrado o acceso denegado'
            ], 404);
        }

        try {
            // Obtener el tipo MIME del archivo
            $mimeType = mime_content_type($fullPath);
            
            // Retornar el archivo con headers apropiados
            return response()->file($fullPath, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'public, max-age=3600', // Cache por 1 hora
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al servir el archivo'
            ], 500);
        }
    }

    /**
     * Limpiar y sanitizar el path del archivo
     * @param string $path
     * @return string
     */
    private function sanitizePath(string $path): string
    {
        // Remover caracteres peligrosos y normalizar el path
        $path = str_replace(['../', './'], '', $path);
        $path = trim($path, '/');
        
        // Convertir barras invertidas a barras normales
        $path = str_replace('\\', '/', $path);
        
        return $path;
    }

    /**
     * Verificar si el archivo es válido y accesible
     * @param string $fullPath
     * @param string $relativePath
     * @return bool
     */
    private function isValidFile(string $fullPath, string $relativePath): bool
    {
        // Verificar que el archivo existe
        if (!file_exists($fullPath) || !is_file($fullPath)) {
            return false;
        }

        // Verificar que el path está dentro del directorio storage/app
        $storagePath = storage_path('app');
        $realFullPath = realpath($fullPath);
        $realStoragePath = realpath($storagePath);
        
        if (!$realFullPath || !$realStoragePath) {
            return false;
        }

        // Verificar que el archivo está dentro del directorio permitido
        if (strpos($realFullPath, $realStoragePath) !== 0) {
            return false;
        }

        // Opcional: Verificar extensiones permitidas
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx'];
        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        
        return in_array($extension, $allowedExtensions);
    }
}
