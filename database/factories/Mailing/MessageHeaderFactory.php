<?php

namespace Database\Factories\Mailing;

use App\Models\Mailing\MessageHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'id' => $this->faker->unique()->word(),
            'description' => 'Test Header',
            'content' => '<h1>Titulo</h1>'
        ];
    }
}
