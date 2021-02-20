<?php

namespace App\Repositories\Billing;

use App\Models\Billing\User;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    /**
     * Create the User Repository.
     *
     * @param User $user
     */
    public function __construct(User $user) 
    {
        $this->model = $user;
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
