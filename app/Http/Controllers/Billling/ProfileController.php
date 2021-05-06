<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Profile\ProfileUpdateRequest;
use App\Http\Resources\Billling\ProfileResource;
use Illuminate\Http\Request;

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
    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user()->fill($request->validated());
        $user->save();

        return new ProfileResource($user);
    }
}