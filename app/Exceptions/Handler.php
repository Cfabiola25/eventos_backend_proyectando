<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Maneja las excepciones de autenticación (sesión expirada)
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => 'Sesión expirada. Por favor inicia sesión nuevamente.'], 401)
            : redirect()->guest(route('login'))->with('message', 'Tu sesión ha expirado. Por favor inicia sesión nuevamente.');
    }

    /**
     * Renderiza las excepciones para capturar 404 sin autenticación
     */
    public function render($request, Throwable $exception)
    {
        // Si es un 404 y el usuario no está autenticado, redirigir al login
        if ($exception instanceof NotFoundHttpException) {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
        }

        return parent::render($request, $exception);
    }
}
