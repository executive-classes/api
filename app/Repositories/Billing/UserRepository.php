<?php

namespace App\Repositories\Billing;

use App\Models\Billing\User;

class UserRepository
{
    /**
     * The User Model.
     */
    protected User $model;

    /**
     * Create the User Repository.
     *
     * @param User $user
     */
    public function __construct(User $user) {
        $this->model = $user;
    }

    /**
     * Find a user by a given id.
     *
     * @param string $id
     * @return void
     */
    public function find(string $id)
    {
        return $this->model
            ->where('id', $id)
            ->first();
    }

    /**
     * Find a user by a given email.
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email)
    {
        return $this->model
            ->where('email', $email)
            ->first();
    }
}
