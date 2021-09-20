<?php

namespace App\Services\Billing\Password;

class Password
{
    /**
     * The available uppercase chars.
     * 
     * @var string
     */
    private static $upperCaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    /**
     * The available lowercase chars.
     * 
     * @var string
     */
    private static $lowerCaseChars = 'abcdefghijklmnopqrstuvwxyz';
    
    /**
     * The available number chars.
     * 
     * @var string
     */
    private static $numberChars = '0123456789';
    
    /**
     * The available special chars.
     * 
     * @var string
     */
    private static $specialChars = '`´-=~!@#$%^&*()_+,.<>?;:[]{}|';

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
        $str .= self::$upperCaseChars[random_int(0, strlen(self::$upperCaseChars) - 1)];
        $str .= self::$lowerCaseChars[random_int(0, strlen(self::$lowerCaseChars) - 1)];
        $str .= self::$numberChars[random_int(0, strlen(self::$numberChars) - 1)];
        $str .= self::$specialChars[random_int(0, strlen(self::$specialChars) - 1)];

        for ($i=0; $i < $length - 4; $i++) {
            $chars = self::$upperCaseChars . self::$lowerCaseChars . self::$numberChars . self::$specialChars;
            $str .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return str_shuffle($str);
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