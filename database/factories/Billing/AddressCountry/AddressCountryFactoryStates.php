<?php

namespace Database\Factories\Billing\AddressCountry;

trait AddressCountryFactoryStates
{
    /**
     * Indicate that the country is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => true
            ];
        });
    }

    /**
     * Indicate that the country is inactive.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inactive()
    {
        return $this->state(function (array $attributes) {
            return [
                'active' => false
            ];
        });
    }
}