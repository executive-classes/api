<?php

namespace App\Http\Controllers\Billling;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\User\ProfileResource;
use App\Http\Requests\Billing\User\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Get the logged user.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return new ProfileResource($request->user());
    }

    /**
     * Updated the logged user.
     *
     * @param ProfileUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user()->fill($request->validated());
        $user->save();

        return new ProfileResource($user->refresh());
    }
}