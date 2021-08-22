<?php

namespace Database\Factories\Mailing\Message;

use App\Enums\Mailing\MessageStatusEnum;
use App\Models\Mailing\Message\Message;
use App\Models\Mailing\MessageTemplate\MessageTemplate;
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
            'message_template_id' => MessageTemplate::factory(),
            'params' => json_encode(['testMessage' => 'Hello World']),
        ];
    }

    /**
     * Indicate that the message is scheduled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function scheduled()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::SCHEDULED,
            ];
        });
    }

    /**
     * Indicate that the message is sent.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function sent()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::SENT,
            ];
        });
    }

    /**
     * Indicate that the message is canceled.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function canceled()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::CANCELED,
            ];
        });
    }

    /**
     * Indicate that the message is with a error.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function error()
    {
        return $this->state(function (array $attributes) {
            return [
                'message_status_id' => MessageStatusEnum::ERROR,
            ];
        });
    }
}
