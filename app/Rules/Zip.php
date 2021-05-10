<?php

namespace App\Rules;

use App\Enums\Billing\CountryEnum;
use Illuminate\Contracts\Validation\Rule;

class Zip implements Rule
{
    /**
     * Country
     * 
     * @var string
     */
    private $country;

    /**
     * Create the Zip rule.
     *
     * @param string $country
     */
    public function __construct(string $country = null)
    {
        $this->country = $country;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->country != CountryEnum::BR) {
            return true;
        }
        
        return preg_match("/^(\d{5}-\d{3}|\d{8})$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('validation.zip');
    }
}

