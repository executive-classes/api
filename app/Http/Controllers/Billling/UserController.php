<?php

namespace App\Http\Controllers\Billling;

use App\Models\Billing\User\UserFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\User\CreateUserRequest;
use App\Http\Requests\Billing\User\UpdateUserRequest;
use App\Http\Resources\Billling\UserCollection;
use App\Http\Resources\Billling\UserResource;
use App\Models\Billing\User\User;
use App\Services\Billing\Password\Password;

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