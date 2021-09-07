<?php

namespace Database\Factories\System\SystemApp;

use Database\Factories\Factory;
use App\Enums\System\SystemAppEnum;
use App\Models\Eloquent\System\SystemApp\SystemApp;

class SystemAppFactory extends Factory
{
    use SystemAppFactoryStates;
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemApp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => SystemAppEnum::getRandomValue(),
            'name' => $this->faker->name,
            'active' => $this->faker->boolean(80),
            'ip' => $this->faker->ipv4,
            'url' => $this->faker->url,
        ];
    }
}