<?php

namespace Tests\Unit\Mailing;

use App\Exceptions\Mailing\MessageException;
use App\Mail\Messenger;
use App\Models\Mailing\Message;
use App\Enums\Mailing\MessageStatusEnum;
use App\Repositories\Mailing\MessageRepository;
use App\Services\Mailing\SendMessageService;
use Tests\Providers\Mailing\MessageProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SendMessageServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker, MessageProvider;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * The Message Repository.
     * 
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * The Messenger.
     *
     * @var Messenger
     */
    protected $messenger;

    /**
     * The Send Message Service
     *
     * @var SendMessageService
     */
    protected $sendMessageService;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->messageRepository = new MessageRepository(new Message());
        $this->messenger = new Messenger();
        $this->sendMessageService = new SendMessageService($this->messageRepository, $this->messenger);
    }

    /**
     * Test if only valid messages will be sent. If the message was invalid, must
     * throw a exception.
     * 
     * @dataProvider getMessages
     * 
     * @return void
     * @throws MessageException
     */
    public function test_can_only_sent_valid_messages(callable $provider)
    {
        [$message] = $provider();

        if (!$message->isReadyForSent()) {
            $this->expectException(MessageException::class);
            $this->expectExceptionMessage(__('mailing.message.fail.send', ['id' => $message->id]));
            $this->expectExceptionCode(400);
        }

        if ((empty($message->content) || empty($message->subject)) && empty($message->message_template_id)) {
            $this->expectException(MessageException::class);
            $this->expectExceptionCode(400);
        }

        $this->sendMessageService->sendMessage($message);

        $message->refresh();
        $this->assertEquals(MessageStatusEnum::SENT, $message->message_status_id);
        $this->assertNotNull($message->sent_at);
    }

    /**
     * Test if the template can be rendered in the message.
     *
     * @return void
     */
    public function test_message_template_can_be_render()
    {
        $message = $this->makeCustomMessage(MessageStatusEnum::SCHEDULED(), $this->makeContentData(false, true));

        $this->sendMessageService->applyTemplate($message);
        $message->refresh();

        $this->assertNotNull($message->content);
        $this->assertNotNull($message->subject);
        $this->assertEquals('<h3>Hello World from a Template</h3>', $message->content);
        $this->assertEquals($message->template->subject, $message->subject);
    }

    /**
     * Test if the template redering will not override the existins content 
     * and subject.
     *
     * @return void
     */
    public function test_template_rendering_do_not_override_default_content()
    {
        $message = $this->makeCustomMessage(MessageStatusEnum::SCHEDULED(), $this->makeContentData(true, true));
        $old_message = $message;

        $this->sendMessageService->applyTemplate($message);
        $message->refresh();

        $this->assertEquals($old_message->content, $message->content);
        $this->assertEquals($old_message->subject, $message->subject);
    }
}
