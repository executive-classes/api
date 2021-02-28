<?php

namespace Tests\Feature\Mailing;

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;
use App\Repositories\Mailing\MessageTemplateRepository;
use App\Traits\Tests\Mailing\MessageTemplateMaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTemplateTest extends TestCase
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

        $this->messageTemplateRepository = new MessageTemplateRepository(new MessageTemplate());
    }

    /**
     * Test if a template can be created in the database.
     *
     * @return void
     */
    public function test_template_can_be_created()
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

        $result = $this->messageTemplateRepository->create($data);

        $this->assertDatabaseHas('message_template', [
            'id' => 'newTest'
        ]);
        $this->assertInstanceOf(MessageTemplate::class, $result);
        $this->assertEquals($result->id, $data['id']);
    }

    /**
     * Test if a template can be updated in the database.
     *
     * @return void
     */
    public function test_template_can_be_updated()
    {
        $this->createTemplate();
        $this->assertDatabaseHas('message_template', [
            'id' => 'newTest'
        ]);

        $data = [
            'description' => 'updatedtest'
        ];

        $result = $this->messageTemplateRepository->update('newTest', $data);
        $template = MessageTemplate::find('newTest');

        $this->assertInstanceOf(MessageTemplate::class, $result);
        $this->assertEquals('updatedtest', $template->description);
    }

    /**
     * Test if a template can be deleted in the database.
     *
     * @return void
     */
    public function test_template_can_be_deleted()
    {
        $this->createTemplate();
        $this->assertDatabaseHas('message_template', [
            'id' => 'newTest'
        ]);

        $result = $this->messageTemplateRepository->delete('newTest');

        $this->assertDatabaseMissing('message_template', [
            'id' => 'newTest'
        ]);
        $this->assertIsInt($result);
        $this->assertEquals(1, $result);
    }
}
