<?php

namespace App\Http\Middleware;

use App\Services\System\AccessLogService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessLog
{
    /**
     * Access Log.
     * 
     * @var \App\Models\System\SystemAccessLog
     */
    private $log;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $log = AccessLogService::access($request);
        $request->merge(['_log' => $log]);

        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate(Request $request, Response $response)
    {
        AccessLogService::response($request->_log, $response);
    }
}
