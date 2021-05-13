<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', $this->getAllowedOrigins())
            ->header('Access-Control-Allow-Methods', config('cors.allowed_methods'))
            ->header('Access-Control-Allow-Headers', config('cors.allowed_headers'));
    }

    /**
     * Handle the allowed origins.
     *
     * @return string|null
     */
    private function getAllowedOrigins()
    {
        $allowedOrigins = config('cors.allowed_origins');
        $origin = $_SERVER['HTTP_ORIGIN'] ?? null;

        return in_array($origin, $allowedOrigins)
            ? $origin
            : null;
    }
}
