<?php

namespace Database\Factories\Mailing\Message;

use Carbon\Carbon;
use App\Models\Eloquent\Mailing\Message\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Mailing\Message\MessageFactoryStates;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;

class MessageFactory extends Factory
{
    use MessageFactoryStates;
    
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
            'message_template_id' => MessageTemplate::factory(),
            'params' => json_encode(['testMessage' => 'Hello World']),
        ];
    }
}
