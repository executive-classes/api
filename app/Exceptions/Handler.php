<?php

namespace App\Exceptions;

use App\Traits\Response\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, \Throwable $exception)
    {
        if (isProduction()) {
            if ($exception instanceof AuthenticationException) {
                return $request->expectsJson()
                ? $this->unauthorizedResponse(__('auth.unauthenticated'))
                : redirect()->guest($exception->redirectTo() ?? route('login'));
            }
            
            if ($exception instanceof AuthorizationException) {
                return $request->expectsJson()
                ? $this->forbiddenResponse(__('auth.unauthorized'))
                : redirect()->guest(route('login'))->withErrors(__('auth.unauthorized'));
            }
        }
            
        return parent::render($request, $exception);
    }
}
