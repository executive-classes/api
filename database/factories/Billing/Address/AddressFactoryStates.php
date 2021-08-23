<?php

namespace Database\Factories\Billing\Address;

use App\Enums\Billing\CountryEnum;

trait AddressFactoryStates
{
    /**
     * Indicate that the address is from Brazil.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function br()
    {
        return $this->state(function (array $attributes) {
            return [
                'country' => CountryEnum::BR,
            ];
        });
    }

    /**
     * Indicate that the address is from United States.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function us()
    {
        return $this->state(function (array $attributes) {
            return [
                'country' => CountryEnum::US,
            ];
        });
    }
}