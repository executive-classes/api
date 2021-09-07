<?php

namespace Database\Factories\System\SystemApp;

trait SystemAppFactoryStates
{
    /**
     * Indicate that the app is active.
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
     * Indicate that the app is inactive.
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