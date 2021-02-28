<?php

namespace Database\Factories\Mailing;

use App\Models\Mailing\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'should_proccess_at' => Carbon::now()->toDateTimeString(),
            'reply_to' => $this->faker->email,
            'to' => $this->faker->email,
            'subject' => 'Test',
            'content' => '<h1>Hello World</h1>',
            'params' => json_encode(['testMessage' => 'Hello World']),
        ];
    }
}
