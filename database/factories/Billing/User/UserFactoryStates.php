<?php

namespace Database\Factories\Billing\User;

use App\Enums\System\SystemLanguageEnum;
use App\Traits\Factories\Billing\TaxStates;

trait UserFactoryStates
{
    use TaxStates;

    /**
     * Indicate that the user use the system in english.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function en()
    {
        return $this->state(function (array $attributes) {
            return [
                'system_language_id' => SystemLanguageEnum::EN
            ];
        });
    }

    /**
     * Indicate that the user use the system in portuguese (brazillian).
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pt_BR()
    {
        return $this->state(function (array $attributes) {
            return [
                'system_language_id' => SystemLanguageEnum::PT_BR
            ];
        });
    }
}