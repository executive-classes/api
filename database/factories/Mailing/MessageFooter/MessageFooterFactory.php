<?php

namespace Database\Factories\Mailing\MessageFooter;

use App\Models\Eloquent\Mailing\MessageFooter\MessageFooter;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFooterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageFooter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => preg_replace('/\s|\./', '', $this->faker->text(20)),
            'description' => 'Test Footer',
            'content' => '<h1>Titulo</h1>'
        ];
    }
}
