<?php

namespace Tests\Providers\Mailing;

use App\Models\Mailing\Message\Message;
use App\Enums\Mailing\MessageStatusEnum;
use App\Models\Mailing\MessageTemplate\MessageTemplate;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Collection;

trait MessageProvider
{
    /**
     * Providers
     */

    public function getMessage()
    {
        return [
            [$this->getMessageFunction()]
        ];
    }

    public function getMessages()
    {
        return [
            'sent-message' => [
                $this->getMessagesFunction(MessageStatusEnum::SENT())
            ],
            'scheduled-message-with-template' => [
                $this->getMessagesFunction(MessageStatusEnum::SCHEDULED(), $this->makeContentData(false, true))
            ],
            'scheduled-message-without-template' => [
                $this->getMessagesFunction(MessageStatusEnum::SCHEDULED(), $this->makeContentData(true, false))
            ],
            'scheduled-message-with-template-and-content' => [
                $this->getMessagesFunction(MessageStatusEnum::SCHEDULED(), $this->makeContentData(true, true))
            ],
            'scheduled-message-without-template-and-content' => [
                $this->getMessagesFunction(MessageStatusEnum::SCHEDULED(), $this->makeContentData(false, false))
            ],
            'canceled-message' => [
                $this->getMessagesFunction(MessageStatusEnum::CANCELED())
            ]
        ];
    }

    /**
     * Providers Functions
     */

    private function getMessageFunction()
    {
        return function () { 
            return [$this->makeMessage()]; 
        };
    }

    private function getMessagesFunction(MessageStatusEnum $messageStatusEnum, array $attributes = []): Closure
    {
        return function () use ($messageStatusEnum, $attributes) { 
            return [$this->makeCustomMessage($messageStatusEnum, $attributes)]; 
        };
    }

    /**
     * Creators
     */

    public function createReadyForSentMessages()
    {
        $correctAttributes = ['should_proccess_at' => Carbon::now()->subDay()->toDateTimeString()];

        $this->makeCustomMessage(MessageStatusEnum::SENT());
        $this->makeCustomMessage(MessageStatusEnum::SCHEDULED(), $correctAttributes);
        $this->makeCustomMessage(MessageStatusEnum::SCHEDULED());
        $this->makeCustomMessage(MessageStatusEnum::CANCELED());
        $this->makeCustomMessage(MessageStatusEnum::ERROR());
    }

    /**
     * Makers
     */

    public function makeMessage(): Message
    {
        return Message::factory()->create();
    }
    
    public function makeMultipleMessages(int $count = 1): Collection
    {
        return Message::factory()->count($count)->create();
    }

    public function makeCustomMessage(MessageStatusEnum $messageStatusEnum, array $attributes = []): Message
    {
        return Message::factory()
            ->{$messageStatusEnum->value}()
            ->create($attributes);
    }

    private function makeContentData(bool $content = true, bool $template = false)
    {
        $this->createApplication();
        $this->setUpFaker();

        return [
            'subject' => $content ? $this->faker->text(100) : null,
            'content' => $content ? $this->faker->text(255) : null,
            'message_template_id' => $template ? MessageTemplate::factory() : null,
            'params' => $template ? json_encode(['testMessage' => 'Hello World']) : null
        ];
    }

}