<?php

namespace Tests\Unit\Mailing;

use App\Exceptions\Mailing\MessageException;
use App\Models\Mailing\Message\Message;
use App\Enums\Mailing\MessageStatusEnum;
use App\Models\Mailing\Message\MessageRepository;
use Tests\Providers\Mailing\MessageProvider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageTest extends TestCase
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
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
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
    public function test_scheduled_message_can_be_canceled(callable $provider)
    {
        [$message] = $provider();

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
    public function test_message_can_be_deleted(callable $provider)
    {
        [$message] = $provider();

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
        $this->createReadyForSentMessages();

        $result = $this->messageRepository->findReadyForSend();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(1, $result);

        foreach ($result as $message) {
            $this->assertInstanceOf(Message::class, $message);
            $this->assertEquals(MessageStatusEnum::SCHEDULED, $message->message_status_id);
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
    public function test_can_add_error_to_invalid_messages(callable $provider)
    {
        [$message] = $provider();

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
        $this->assertNotEquals(MessageStatusEnum::ERROR, $message->message_status_id);
        $this->assertTrue($result);

        $result = $this->messageRepository->addError($message);
        $message->refresh();

        $this->assertTrue($result);
        $this->assertEquals(MessageStatusEnum::ERROR, $message->message_status_id);
        $this->assertEquals(0, $message->retries);
    }
}
