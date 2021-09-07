<?php

namespace Database\Factories\System\SystemLanguage;

use Database\Factories\Factory;
use App\Enums\System\SystemLanguageEnum;
use App\Models\Eloquent\System\SystemLanguage\SystemLanguage;

class SystemLanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SystemLanguage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => SystemLanguageEnum::getRandomValue(),
            'name' => $this->faker->languageCode
        ];
    }
}