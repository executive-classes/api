<?php

namespace App\Traits\Tests\Mailing;

use App\Models\Mailing\Message;
use App\Models\Mailing\MessageStatus;
use Carbon\Carbon;

trait MessageMaker
{
    /**
     * Create messages in the database.
     *
     * @return void
     */
    public function createMessages()
    {
        $messages = [
            $this->makeSentMessage(),
            $this->makeScheduledMessageWithTemplate(),
            $this->makeScheduledMessageWithoutTemplate(),
            $this->makeScheduledMessageWithTemplateAndContent(),
            $this->makeScheduledMessageWithoutTemplateAndContent(),
            $this->makeCanceledMessage()
        ];

        foreach ($messages as $message) {
            $message->save();
        }
    }

    /**
     * Return the Message instaces
     *
     * @return array
     */
    public function getMessages()
    {
        $this->createApplication();
        return [
            'sent-message' => [$this->makeSentMessage()],
            'scheduled-message-with-template' => [$this->makeScheduledMessageWithTemplate()],
            'scheduled-message-without-template' => [$this->makeScheduledMessageWithoutTemplate()],
            'scheduled-message-with-template-and-content' => [$this->makeScheduledMessageWithTemplateAndContent()],
            'scheduled-message-without-template-and-content' => [$this->makeScheduledMessageWithoutTemplateAndContent()],
            'canceled-message' => [$this->makeCanceledMessage()],
        ];
    }

    /**
     * Return the Scheduled Messages Instances
     *
     * @return array
     */
    public function getScheduledMessages()
    {
        $this->createApplication();
        return [
            'scheduled-message-with-template' => [$this->makeScheduledMessageWithTemplate()],
            'scheduled-message-without-template' => [$this->makeScheduledMessageWithoutTemplate()],
            'scheduled-message-with-template-and-content' => [$this->makeScheduledMessageWithTemplateAndContent()],
            'scheduled-message-without-template-and-content' => [$this->makeScheduledMessageWithoutTemplateAndContent()],
        ];
    }

    /**
     * Create a sent message.
     *
     * @return Message
     */
    private function makeSentMessage()
    {
        return new Message([
            'should_proccess_at' => Carbon::now()->subDay()->toDateTimeString(),
            'message_status_id' => MessageStatus::SENT,
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => null,
            'content' => null,
            'message_template_id' => 'test',
            'params' => json_encode(['testMessage' => 'Hello World'])
        ]);
    }

    /**
     * Create a scheduled message only with a template.
     *
     * @return Message
     */
    private function makeScheduledMessageWithTemplate()
    {
        return new Message([
            'should_proccess_at' => Carbon::now()->subDay()->toDateTimeString(),
            'message_status_id' => MessageStatus::SCHEDULED,
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => null,
            'content' => null,
            'message_template_id' => 'test',
            'params' => json_encode(['testMessage' => 'Hello World'])
        ]);
    }

    /**
     * Create a scheduled message only with content 
     *
     * @return Message
     */
    private function makeScheduledMessageWithoutTemplate()
    {
        return new Message([
            'should_proccess_at' => Carbon::now()->subDay()->toDateTimeString(),
            'message_status_id' => MessageStatus::SCHEDULED,
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => 'Test',
            'content' => '<h1>Hello World</h1>',
            'message_template_id' => null,
            'params' => null,
            'retries' => 1
        ]);
    }

    /**
     * Create a scheduled message with Template and Content
     *
     * @return Message
     */
    private function makeScheduledMessageWithTemplateAndContent()
    {
        return new Message([
            'should_proccess_at' => Carbon::now()->subDay()->toDateTimeString(),
            'message_status_id' => MessageStatus::SCHEDULED,
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => 'Test',
            'content' => '<h1>Hello World</h1>',
            'message_template_id' => 'test',
            'params' => json_encode(['testMessage' => 'Hello World'])
        ]);
    }

    /**
     * Create a scheduled message without template and content
     *
     * @return Message
     */
    private function makeScheduledMessageWithoutTemplateAndContent()
    {
        return new Message([
            'should_proccess_at' => Carbon::now()->subDay()->toDateTimeString(),
            'message_status_id' => MessageStatus::SCHEDULED,
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => null,
            'content' => null,
            'message_template_id' => null,
            'params' => null
        ]);
    }

    /**
     * Create a canceled message.
     *
     * @return Message
     */
    private function makeCanceledMessage()
    {
        return new Message([
            'should_proccess_at' => Carbon::now()->subDay()->toDateTimeString(),
            'message_status_id' => MessageStatus::CANCELED,
            'reply_to' => 'example@test.com',
            'to' => 'example@test.com',
            'subject' => null,
            'content' => null,
            'message_template_id' => 'test',
            'params' => json_encode(['testMessage' => 'Hello World'])
        ]);
    }
}