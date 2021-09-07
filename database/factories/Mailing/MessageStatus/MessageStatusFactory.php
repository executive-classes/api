<?php

namespace Database\Factories\Mailing\MessageStatus;

use Database\Factories\Factory;
use App\Enums\Mailing\MessageStatusEnum;
use App\Models\Eloquent\Mailing\MessageStatus\MessageStatus;

class MessageStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => MessageStatusEnum::getRandomValue()
        ];
    }
}