<?php

namespace App\Services\System;

use App\Models\System\SystemAccessLog\SystemAccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AccessLogService
{
    public static function access(Request $request): SystemAccessLog
    {
        $user = $request->user();
        $route = $request->route();
        $log = new SystemAccessLog();

        $log->user_id = $user ? $user->id : null;
        $log->cross_user_id = $user ? $user->crossId() : null;
        $log->agent = $request->userAgent();
        $log->method = $request->method();
        $log->url = $request->fullUrl();
        $log->route = $route ? $route->getName() : $request->getRequestUri();
        $log->ajax = $request->ajax();
        
        $log->save();

        return $log;
    }

    public static function response(SystemAccessLog $log = null, Response $response): void
    {
        if ($log) {
            $log->code = $response->getStatusCode();
            $log->allowed = !in_array($log->code, [403, 401]);
            $log->save();
        }
    }
}