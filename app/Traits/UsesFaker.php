<?php

namespace App\Traits;

use Faker\Generator as Faker;
use Illuminate\Container\Container;

trait UsesFaker
{
    /**
     * The Faker.
     *
     * @var Faker
     */
    protected $faker;

    /**
     * Creates the faker.
     *
     * @return void
     */
    private function createFaker(): void
    {
        $this->faker = Container::getInstance()->make(Faker::class);
    }

    /**
     * Returns the faker.
     *
     * @return Faker
     */
    protected function faker(): Faker
    {
        if (!isset($faker)) {
            $this->createFaker();
        }

        return $this->faker;
    }
}