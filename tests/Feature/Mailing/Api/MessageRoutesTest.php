<?php

namespace Tests\Feature\Mailing\Api;

use App\Models\Billing\User;
use App\Models\Mailing\Message;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        User::admin()->first()->login();
    }
    
    /**
     * Test the return of the message list route.
     *
     * @return void
     */
    public function test_message_list_route_returns_message_list()
    {
        $response = $this->getJson('/api/messages');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(1, 'data');
    }

    /**
     * Test the return of the message show route.
     *
     * @return void
     */
    public function test_message_show_route_returns_a_message()
    {
        $message = Message::first();
        $response = $this->getJson('/api/messages/' . $message->id);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $message->id);
    }

    /**
     * Test the return of the message creation route.
     *
     * @return void
     */
    public function test_message_create_route_returns_the_new_message()
    {
        $data = [
            'should_proccess_at' => Carbon::now()->addDay()->toDateTimeString(),
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => null,
            'content' => null,
            'message_template_id' => 'test',
            'params' => json_encode(['testMessage' => 'Hello World'])
        ];
        
        $response = $this->postJson('/api/messages', $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.to', $data['to']);
    }

    /**
     * Test the return of the message cancel route.
     *
     * @return void
     */
    public function test_message_cancel_route_returns_a_confirmation()
    {
        $message = Message::first();
        $message->save();
        $response = $this->patchJson('/api/messages/' . $message->id . '/cancel');

        $response->assertNoContent();
    }

    /**
     * Test the return of the message delete route.
     *
     * @return void
     */
    public function test_message_delete_route_returns_a_confirmation()
    {
        $message = Message::first();
        $message->save();
        $response = $this->deleteJson('/api/messages/' . $message->id);

        $response->assertNoContent();
    }
}
