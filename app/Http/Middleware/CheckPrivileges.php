<?php

namespace App\Http\Middleware;

use App\Enums\Billing\UserPrivilegeEnum;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CheckPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $privilege)
    {
        if (!$request->user()->tokenCan($privilege)) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
