<?php

namespace App\Repositories\Mailing;

use App\Models\Mailing\Message;
use App\Repositories\Repository;
use App\Exceptions\Mailing\MessageException;
use App\Models\Mailing\MessageStatus;
use Carbon\Carbon;

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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findReadyForSend()
    {
        return $this->model
            ->with('template')
            ->where('message_status_id', MessageStatus::SCHEDULED)
            ->where('should_proccess_at', '<', Carbon::now()->toDateTimeString())
            ->get();
    }

    /**
     * Mark a message as send.
     *
     * @param Message|string $message
     * @return void
     */
    public function sendMessage($message)
    {
        // Checks if the message is a instance or a id.
        if (!$message instanceof Message) {
            $message = $this->find($message);
        }

        $message->message_status_id = MessageStatus::SENT;
        $message->sent_at = Carbon::now()->toDateTimeString();
        $message->save();
        
        return $message->message_status_id == MessageStatus::SENT;
    }

    /**
     * Cancel a scheduled message.
     *
     * @param Message|string $message
     * @return boolean
     */
    public function cancelScheduledMessage($message): bool
    {
        // Checks if the message is a instance or a id.
        if (!$message instanceof Message) {
            $message = $this->find($message);
        }

        if ($message->wasCanceled()) {
            return true;
        }

        if ($message->wasSent()) {
            throw new MessageException(__('mailing.message.fail.cancel', ['id' => $message->id]), 400);
        }

        $message->message_status_id = MessageStatus::CANCELED;
        $message->should_proccess_at = null;
        $message->save();

        return $message->message_status_id == MessageStatus::CANCELED;
    }

    /**
     * Add a error count to a message.
     *
     * @param Message|string $message
     * @param Exception|null $exception
     * @return bool
     */
    public function addError($message, $exception = null)
    {
        // Checks if the message is a instance or a id.
        if (!$message instanceof Message) {
            $message = $this->find($message);
        }

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
            $message->message_status_id = MessageStatus::ERROR;
        }

        $message->save();
        return true;
    }
}
