<?php

namespace Tests\Feature\Mailing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Enums\Mailing\MessageStatusEnum;
use App\Models\Eloquent\Mailing\Message\Message;

class MessageTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('messages.list'));
        $this->assertAuthenticationRequired(route('messages.show', ['message' => 1]));
        $this->assertAuthenticationRequired(route('messages.create'), 'POST');
        $this->assertAuthenticationRequired(route('messages.cancel', ['message' => 1]), 'DELETE');
    }

    public function test_messages_list()
    {
        // Data creation
        $this->createMany(Message::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('messages.list'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_messages_show()
    {
        // Data creation
        $message = $this->createOne(Message::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('messages.show', ['message' => $message->id]));
        

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_messages_create()
    {
        // Data creation
        $message = $this->makeOne(Message::class, true);
        $data = collect($message->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('messages.create'), $message->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('message', $data->only(['reply_to','to','subject'])->toArray());
    }

    public function test_messages_cancel()
    {
        // Data creation
        $message = $this->createOne(Message::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('messages.cancel', ['message' => $message->id]));

        // Assertions
        $this->assertResponseJson($response, 204);
        $this->assertDatabaseHas('message', [
            'id' => $message->id, 
            'message_status_id' => MessageStatusEnum::CANCELED
        ]);
    }
}