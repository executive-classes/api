<?php

namespace App\Http\Controllers\Billing;

use App\Models\Eloquent\Billing\User\User;
use App\Http\Controllers\Controller;
use App\Models\Eloquent\Billing\User\UserFilters;
use App\Services\Billing\Password\Password;
use App\Http\Resources\Billing\User\UserResource;
use App\Http\Resources\Billing\User\UserCollection;
use App\Http\Requests\Billing\User\CreateUserRequest;
use App\Http\Requests\Billing\User\UpdateUserRequest;

class UserController extends Controller
{
    public function index(UserFilters $filter)
    {
        return new UserCollection(User::filter($filter)->get());
    }

    public function store(CreateUserRequest $request)
    {
        $user = new User($request->validated());
        $user->password = Password::generate();
        $user->save();

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->validated());
        $user->save();

        return new UserResource($user);
    }

    public function cancel(User $user)
    {
        $user->active = false;
        $user->save();

        return new UserResource($user);
    }
}