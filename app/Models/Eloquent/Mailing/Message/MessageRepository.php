<?php

namespace App\Models\Eloquent\Mailing\Message;

use App\Models\Eloquent\Mailing\Message\Message;
use App\Support\Repositories\Repository;
use App\Exceptions\Mailing\MessageException;
use App\Enums\Mailing\MessageStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository extends Repository
{
    /**
     * Create the Message Repository.
     *
     * @param Message $message
     */
    public function __construct(Message $message) 
    {
        $this->model = $message;
    }

    /**
     * Find the messages that are ready for send.
     *
     * @return Collection
     */
    public function findReadyForSend(): Collection
    {
        return $this->model
            ->with('template')
            ->where('message_status_id', MessageStatusEnum::SCHEDULED)
            ->where('should_process_at', '<', Carbon::now()->toDateTimeString())
            ->get();
    }

    /**
     * Mark a message as send.
     *
     * @param Message|string $message
     * @return bool
     */
    public function sendMessage($message): bool
    {
        $message = $this->getModel($message);

        $message->message_status_id = MessageStatusEnum::SENT;
        $message->sent_at = Carbon::now()->toDateTimeString();
        $message->save();
        
        return $message->message_status_id == MessageStatusEnum::SENT;
    }

    /**
     * Cancel a scheduled message.
     *
     * @param Message|string $message
     * @return boolean
     */
    public function cancelScheduledMessage($message): bool
    {
        $message = $this->getModel($message);

        if ($message->wasCanceled()) {
            return true;
        }

        if ($message->wasSent()) {
            throw new MessageException(__('mailing.message.fail.cancel', ['id' => $message->id]), 400);
        }

        $message->message_status_id = MessageStatusEnum::CANCELED;
        $message->should_process_at = null;
        $message->save();

        return $message->message_status_id == MessageStatusEnum::CANCELED;
    }

    /**
     * Add a error count to a message.
     *
     * @param Message|string $message
     * @param Exception|null $exception
     * @return bool
     */
    public function addError($message, $exception = null): bool
    {
        $message = $this->getModel($message);

        if (!$message->isScheduled()) {
            throw new MessageException(__('mailing.message.fail.add_error', ['id' => $message->id]), 400);
        }

        if (!empty($exception)) {
            $message->error_message = $exception->getMessage();
        }

        if ($message->retries > 0) {
            $message->retries -= 1;
        }

        if ($message->retries == 0 && $message->isScheduled()) {
            $message->message_status_id = MessageStatusEnum::ERROR;
        }

        return (bool) $message->save();
    }
}
