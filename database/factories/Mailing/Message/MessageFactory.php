<?php

namespace Database\Factories\Mailing\Message;

use App\Enums\Mailing\MessageStatusEnum;
use Carbon\Carbon;
use App\Models\Eloquent\Mailing\Message\Message;
use Database\Factories\Mailing\Message\MessageFactoryStates;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use Database\Factories\Factory;

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
            'id' => $this->id(),
            'should_proccess_at' => Carbon::now()->toDateTimeString(),
            'message_status_id' => MessageStatusEnum::getRandomValue(),
            'reply_to' => $this->faker->email,
            'to' => $this->faker->email,
            'subject' => 'Test',
            'content' => '<h1>Hello World</h1>',
            'message_template_id' => $this->relation(MessageTemplate::class),
            'params' => json_encode(['testMessage' => 'Hello World']),
        ];
    }
}
