<?php

namespace Database\Factories\Mailing\MessageTemplate;

use App\Models\Eloquent\Mailing\MessageFooter\MessageFooter;
use App\Models\Eloquent\Mailing\MessageHeader\MessageHeader;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use App\Models\Eloquent\Mailing\MessageType\MessageType;
use Database\Factories\Factory;

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
            'id' => preg_replace('/\s|\./', '', $this->faker->text(20)),
            'message_type_id' => MessageType::inRandomOrder()->first(),
            'description' => $this->faker->text(),
            'subject' => $this->faker->text(50),
            'content' => '<h3>{{$testMessage}} from a Template</h3>',
            'message_header_id' => $this->relation(MessageHeader::class),
            'message_footer_id' => $this->relation(MessageFooter::class)
        ];
    }
}
