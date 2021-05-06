<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CrossLoginRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Billing\User;
use App\Repositories\Billing\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticateController extends Controller
{
    /**
     * The User Respository.
     */
    protected UserRepository $userRepository;

    /**
     * Create the authentication controller.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Log in with the given credentials.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $user = User::firstWhere('email', $request->email);

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

        return api()->ok($token);
    }

    /**
     * Cross auth in another user.
     *
     * @param CrossLoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function crossLogin(CrossLoginRequest $request)
    {
        // Log in the logged user in the given user
        $cross_user = $this->userRepository->find($request->user_id);
        $token = $cross_user->crossLogin($request->user(), $request->userAgent());

        return api()->ok($token);
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
