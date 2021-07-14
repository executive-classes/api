<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CrossLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\TokenResource;
use App\Models\Billing\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;

class AuthenticateController extends Controller
{
    /**
     * Log in with the given credentials.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $user = User::firstWhere('email', $request->email);

        // Validate if the user is active
        if (!$user->active) {
            return api()->forbidden(__('auth.inactive'));
        }

        // Validate the credentials
        if (!$user->check($request->password)) {
            return api()->badRequest(__('auth.password'));
        }

        // Log in the user and gets the created token
        $token = $user->login($request->email, $request->userAgent());

        // Set the token in the remember_token user's column
        if ($request->get('remember_me', false)) {
            $user->setRememberToken($token->plainTextToken);
            $user->save();
        }

        return new TokenResource($token);
    }

    /**
     * Cross auth in another user.
     *
     * @param CrossLoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function crossLogin(CrossLoginRequest $request)
    {
        $cross_user = User::find($request->user_id);

        // Validate if the user is active
        if (!$cross_user->active) {
            return api()->forbidden(__('auth.inactive'));
        }

        // Log in the logged user in the given user
        $token = $cross_user->crossLogin($request->user(), $request->userAgent());

        return new TokenResource($token);
    }

    /**
     * Get the token information.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function token(Request $request)
    {
        return new TokenResource(new NewAccessToken($request->user()->currentAccessToken(), $request->bearerToken()));
    }

    /**
     * Log out the logged user.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->logout();
        }
        
        return api()->noContent();
    }
}
