<?php

namespace Tests\Feature\Mailing;

use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Mailing\Message\Message;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use Tests\Providers\Mailing\MessageProvider;
use Tests\Providers\Mailing\MessageTemplateProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class MessageRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers, MessageProvider, MessageTemplateProvider;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->getDevUser()->login();
    }
    
    /**
     * Test the return of the message list route.
     *
     * @return void
     */
    public function test_message_list_route_returns_message_list()
    {
        $this->makeMultipleMessages(2);

        $response = $this->getJson('/api/messages');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Message::count(), 'data');
    }

    /**
     * Test the return of the message show route.
     *
     * @dataProvider getMessage
     * 
     * @return void
     */
    public function test_message_show_route_returns_a_message(callable $provider)
    {
        [$message] = $provider();

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
            'message_template_id' => MessageTemplate::factory()->create()->id,
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
     * @dataProvider getMessage
     * 
     * @return void
     */
    public function test_message_cancel_route_returns_a_confirmation(callable $provider)
    {
        [$message] = $provider();

        $response = $this->deleteJson('/api/messages/' . $message->id);

        $response->assertNoContent();
    }
}
