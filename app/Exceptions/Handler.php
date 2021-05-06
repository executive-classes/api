<?php

namespace App\Exceptions;

use App\Services\System\BugLogService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
                    ? api()->unauthorized(__('auth.unauthenticated'))
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
            }
            
            if ($exception instanceof AuthorizationException) {
                return $request->expectsJson()
                    ? api()->forbidden(__('auth.unauthorized'))
                    : redirect()->guest(route('login'))->withErrors(__('auth.unauthorized'));
            }
        }

        BugLogService::log($request, $exception);

        if ($exception instanceof ApiException) {
            return api()->error($exception->getCode(), $exception->getMessage());
        }
        
        return parent::render($request, $exception);
    }
}
