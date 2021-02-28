<?php

namespace Database\Factories\Mailing;

use App\Models\Mailing\MessageTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MessageTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 'test',
            'description' => $this->faker->text(),
            'subject' => $this->faker->word(),
            'content' => '<h3>{{$testMessage}} from a Template</h3>'
        ];
    }
}
