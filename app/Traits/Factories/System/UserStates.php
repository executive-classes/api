<?php

namespace App\Traits\Factories\System;

use App\Models\Eloquent\Billing\User\User;

trait UserStates
{
    /**
     * Indicate that the log has a user.
     *
     * @param boolean $hasUser
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function user(bool $hasUser = true)
    {
        $user = $hasUser
            ? $this->relation(User::class)
            : null;

        return $this->state(function (array $attributes) use ($user) {
            return [
                'user_id' => $user,
            ];
        });
    }

    /**
     * Indicate that the log has a cross user.
     *
     * @param boolean $hasCrossUser
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cross_user(bool $hasCrossUser = true)
    {
        $cross_user = $hasCrossUser
            ? $this->relation(User::class)
            : null;

        return $this->state(function (array $attributes) use ($cross_user) {
            return [
                'cross_user_id' => $cross_user,
            ];
        });
    }

}