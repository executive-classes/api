<?php

namespace Database\Factories\Mailing\MessageHeader;

use App\Models\Eloquent\Mailing\MessageHeader\MessageHeader;
use Database\Factories\Factory;

class MessageHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => preg_replace('/\s|\./', '', $this->faker->text(20)),
            'description' => 'Test Header',
            'content' => '<h1>Titulo</h1>'
        ];
    }
}
