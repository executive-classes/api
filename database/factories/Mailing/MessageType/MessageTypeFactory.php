<?php

namespace Database\Factories\Mailing\MessageType;

use Database\Factories\Factory;
use App\Enums\Mailing\MessageTypeEnum;
use App\Models\Eloquent\Mailing\MessageType\MessageType;

class MessageTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => MessageTypeEnum::getRandomValue()
        ];
    }
}