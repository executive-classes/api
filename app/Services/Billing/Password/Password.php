<?php

namespace App\Services\Billing\Password;

class Password
{
    /**
     * The avaiable chars.
     * 
     * @var string
     */
    private static $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`´-=~!@#$%^&*()_+,./<>?;:[]{}\|';

    /**
     * Generate a password.
     *
     * @param integer $length
     * @return string
     */
    public static function generate(int $length = 15): string
    {
        if ($length < 8) {
            $length = 8;
        }
        
        $str = '';

        for ($i=0; $i < $length; $i++) {
            $str .= self::$chars[random_int(0, strlen(self::$chars) - 1)];
        }

        return $str;
    }

    /**
     * Validate a password.
     *
     * @param string $password
     * @return boolean
     */
    public static function validate(string $password): bool
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\W|_])(?=.{8}).*$/', $password);
    }
}