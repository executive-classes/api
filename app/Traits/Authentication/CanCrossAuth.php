<?php

namespace App\Traits\Authentication;

use App\Models\Billing\User\User;

trait CanCrossAuth
{
    public function crossEmail()
    {
        try {
            $token = $this->currentAccessToken();
            $email = explode('|', $token->name)[0];

            if ($email == $this->email) {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
        
        return filter_var($email, FILTER_VALIDATE_EMAIL)
            ? $email
            : null;
    }

    public function crossUser()
    {
        return User::firstWhere('email', $this->crossEmail());
    }

    public function crossId()
    {
        return $this->crossUser()->id ?? null;
    }
}