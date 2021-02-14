<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ApplyChoosedLanguage
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
        $user = request()->user();

        // Set the language defined in the user's token
        if (isset($user)) {
            $token = $user->currentAccessToken();
            App::setLocale($token->language ?? 'en');
        }

        return $next($request);
    }
}
