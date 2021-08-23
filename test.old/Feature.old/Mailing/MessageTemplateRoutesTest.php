<?php

namespace Tests\Feature\Mailing;

use App\Models\Eloquent\Billing\User\User;
use App\Models\Eloquent\Mailing\MessageFooter\MessageFooter;
use App\Models\Eloquent\Mailing\MessageHeader\MessageHeader;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;
use App\Models\Eloquent\Mailing\MessageType\MessageType;
use Tests\Providers\Mailing\MessageTemplateProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class MessageTemplateRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers, MessageTemplateProvider;

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
     * Test the return of the template list route.
     *
     * @return void
     */
    public function test_message_template_list_route_returns_a_list()
    {
        $this->makeMultipleMessageTemplates(2);

        $response = $this->getJson('/api/messages_templates');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(MessageTemplate::count(), 'data');
    }

    /**
     * Test the return of the template show route.
     *
     * @dataProvider getMessageTemplate
     * 
     * @return void
     */
    public function test_message_template_show_route_returns_a_template(callable $provider)
    {
        [$template] = $provider();

        $response = $this->getJson("/api/messages_templates/{$template->id}");

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $template->id);
    }

    /**
     * Test the return of the template creation route.
     *
     * @return void
     */
    public function test_message_template_create_route_returns_the_new_template()
    {
        $data = [
            'id' => 'newTest',
            'description' => 'test',
            'subject' => 'test',
            'content' => 'test',
            'message_type_id' => MessageType::inRandomOrder()->first()->id,
            'message_header_id' => MessageHeader::factory()->create()->id,
            'message_footer_id' => MessageFooter::factory()->create()->id,
        ];
        
        $response = $this->postJson('/api/messages_templates', $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', 'newTest');
    }

    /**
     * Test the return of the template update route.
     *
     * @dataProvider getMessageTemplate
     *
     * @return void
     */
    public function test_message_template_update_route_returns_the_updated_template(callable $provider)
    {
        [$template] = $provider();

        $data = [
            'description' => 'newTest',
        ];
        
        $response = $this->putJson("/api/messages_templates/{$template->id}", $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.description', 'newTest');
    }

    /**
     * Test the return of the template delete route.
     *
     * @dataProvider getMessageTemplate
     *
     * @return void
     */
    public function test_message_template_delete_route_returns_a_confirmation(callable $provider)
    {
        [$template] = $provider();

        $response = $this->deleteJson('/api/messages_templates/' . $template->id);

        $response->assertNoContent();
    }
}
