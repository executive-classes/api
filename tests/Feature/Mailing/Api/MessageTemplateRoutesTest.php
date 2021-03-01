<?php

namespace Tests\Feature\Mailing\Api;

use App\Models\Billing\User;
use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;
use App\Traits\Tests\Mailing\MessageTemplateMaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTemplateRoutesTest extends TestCase
{
    use RefreshDatabase, MessageTemplateMaker;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        User::dev()->first()->login();
    }

    /**
     * Test the return of the template list route.
     *
     * @return void
     */
    public function test_message_template_list_route_returns_a_list()
    {
        $response = $this->getJson('/api/messages_templates');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(1, 'data');
    }

    /**
     * Test the return of the template show route.
     *
     * @return void
     */
    public function test_message_template_show_route_returns_a_template()
    {
        $response = $this->getJson('/api/messages_templates/test');

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', 'test');
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
            'message_type_id' => MessageType::first()->id,
            'message_header_id' => MessageHeader::first()->id,
            'message_footer_id' => MessageFooter::first()->id,
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
     * @return void
     */
    public function test_message_template_update_route_returns_the_updated_template()
    {
        $data = [
            'description' => 'newTest',
        ];
        
        $response = $this->putJson('/api/messages_templates/test', $data);

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
     * @return void
     */
    public function test_message_template_delete_route_returns_a_confirmation()
    {
        $template = $this->createTemplate();
        $response = $this->deleteJson('/api/messages_templates/' . $template->id);

        $response->assertNoContent();
    }
}
