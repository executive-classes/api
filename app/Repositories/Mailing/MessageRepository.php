<?php

namespace App\Repositories\Mailing;

use App\Models\Mailing\Message;
use App\Repositories\Repository;
use App\Exceptions\Mailing\MessageException;
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
            ->where('message_status_id', Message::SCHEDULED)
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

        $message->status = Message::SENT;
        $message->sent_at = Carbon::now()->toDateTimeString();
        $message->save();
        
        return $message->status == Message::SENT;
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

        if ($message->status == Message::CANCELED) {
            return true;
        }

        if ($message->status != Message::SCHEDULED) {
            throw new MessageException(__('mailing.message.fail.cancel'), 400);
        }

        $message->status = Message::CANCELED;
        $message->should_proccess_at = null;
        $message->save();

        return $message->status == Message::CANCELED;
    }
}
