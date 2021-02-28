<?php

namespace Tests\Feature\Mailing;

use App\Exceptions\Mailing\MessageException;
use App\Models\Mailing\Message;
use App\Models\Mailing\MessageStatus;
use App\Repositories\Mailing\MessageRepository;
use App\Traits\Tests\Mailing\MessageMaker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase, MessageMaker;

    /**
     * The Message Repository.
     * 
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
        
        $this->messageRepository = new MessageRepository(new Message());
    }

    /**
     * Test if the messages can be created in the database.
     *
     * @return void
     */
    public function test_message_can_be_created()
    {
        $messageData = [
            "should_proccess_at" => Carbon::now()->toDateTimeString(),
            "reply_to" => 'exemple@test.com',
            "to" => 'exemple@test.com',
            "subject" => "Teste"
        ];

        $message = $this->messageRepository->create($messageData);

        $this->assertInstanceOf(Message::class, $message);
        $this->assertDatabaseHas('message', [
            'id' => $message->id,
        ]);
    }

    /**
     * Test if a scheduled message can be canceled and not scheduled throw errors.
     * 
     * @dataProvider getMessages
     * 
     * @return void
     * @throws MessageException
     */
    public function test_scheduled_message_can_be_canceled(Message $message)
    {
        if ($message->wasSent()) {
            $this->expectException(MessageException::class);
            $this->expectExceptionMessage(__('mailing.message.fail.cancel', ['id' => $message->id]));
            $this->expectExceptionCode(400);
        }

        $result = $this->messageRepository->cancelScheduledMessage($message);
        $message->refresh();

        $this->assertTrue($result);
        $this->assertTrue($message->wasCanceled());
    }

    /**
     * Test if a created message can be deleted in the database.
     * 
     * @dataProvider getMessages
     * 
     * @return void
     */
    public function test_message_can_be_deleted(Message $message)
    {
        $message->save();
        $message->refresh();

        $result = $this->messageRepository->delete($message->id);

        $this->assertIsInt($result);
        $this->assertEquals(1, $result);
        $this->assertDatabaseMissing('message', [
            'id' => $message->id
        ]);
    }

    /**
     * Test if the repository can ger only the messages ready for be sent.
     *
     * @return void
     */
    public function test_get_only_messages_ready_for_sent()
    {
        $this->createMessages();

        $result = $this->messageRepository->findReadyForSend();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(4, $result);

        foreach ($result as $message) {
            $this->assertInstanceOf(Message::class, $message);
            $this->assertEquals(MessageStatus::SCHEDULED, $message->message_status_id);
            $this->assertLessThanOrEqual(Carbon::now()->toDateTimeString(), $message->should_proccess_at);
        }
    }

    /**
     * Test if a error can be added in a scheduled message. If the message is 
     * not scheduled, should throw a error.
     * 
     * @dataProvider getMessages
     * 
     * @return void
     */
    public function test_can_add_error_to_invalid_messages(Message $message)
    {
        if (!$message->isScheduled()) {
            $this->expectException(MessageException::class);
            $this->expectExceptionMessage(__('mailing.message.fail.add_error', ['id' => $message->id]));
            $this->expectExceptionCode(400);
        }

        $message->retries = 2;
        $message->save();

        $result = $this->messageRepository->addError($message);
        $message->refresh();

        $this->assertEquals(1, $message->retries);
        $this->assertNotEquals(MessageStatus::ERROR, $message->message_status_id);
        $this->assertTrue($result);

        $result = $this->messageRepository->addError($message);
        $message->refresh();

        $this->assertTrue($result);
        $this->assertEquals(MessageStatus::ERROR, $message->message_status_id);
        $this->assertEquals(0, $message->retries);
    }

}
