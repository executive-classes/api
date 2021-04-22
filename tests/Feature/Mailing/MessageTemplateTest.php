<?php

namespace Tests\Feature\Mailing;

use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use App\Models\Mailing\MessageType;
use App\Repositories\Mailing\MessageTemplateRepository;
use App\Traits\Providers\Mailing\MessageTemplateProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTemplateTest extends TestCase
{
    use RefreshDatabase, MessageTemplateProvider;

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
            'message_type_id' => MessageType::inRandomOrder()->first()->id,
            'message_header_id' => MessageHeader::factory()->create()->id,
            'message_footer_id' => MessageFooter::factory()->create()->id,
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
     * @dataProvider getMessageTemplate
     * 
     * @return void
     */
    public function test_template_can_be_updated(callable $provider)
    {
        [$template] = $provider();

        $this->assertDatabaseHas('message_template', [
            'id' => $template->id
        ]);

        $data = [
            'description' => 'updatedtest'
        ];

        $result = $this->messageTemplateRepository->update($template->id, $data);
        $template->refresh();

        $this->assertInstanceOf(MessageTemplate::class, $result);
        $this->assertEquals('updatedtest', $template->description);
    }

    /**
     * Test if a template can be deleted in the database.
     *
     * @dataProvider getMessageTemplate
     *
     * @return void
     */
    public function test_template_can_be_deleted(callable $provider)
    {
        [$template] = $provider();

        $this->assertDatabaseHas('message_template', [
            'id' => $template->id
        ]);

        $result = $this->messageTemplateRepository->delete($template->id);

        $this->assertDatabaseMissing('message_template', [
            'id' => $template->id
        ]);
        $this->assertIsInt($result);
        $this->assertEquals(1, $result);
    }
}
