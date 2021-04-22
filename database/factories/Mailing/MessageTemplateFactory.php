<?php

namespace Database\Factories\Mailing;

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;
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
            'id' => $this->faker->unique()->word(),
            'message_type_id' => MessageType::inRandomOrder()->first(),
            'description' => $this->faker->text(),
            'subject' => $this->faker->text(50),
            'content' => '<h3>{{$testMessage}} from a Template</h3>',
            'message_header_id' => MessageHeader::factory(),
            'message_footer_id' => MessageFooter::factory()
        ];
    }
}
