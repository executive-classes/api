<?php

namespace App\Services\Mailing;

use App\Exceptions\Mailing\MessageException;
use App\Mail\Messenger;
use App\Models\Eloquent\Mailing\Message\Message;
use App\Models\Eloquent\Mailing\Message\MessageRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;

class SendMessageService
{
    /**
     * The Message Repository
     */
    protected MessageRepository $messageRepository;

    /**
     * The Messenger
     */
    protected Messenger $messenger;

    /**
     * Creates a Send Message Service
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository, Messenger $messenger) {
        $this->messageRepository = $messageRepository;
        $this->messenger = $messenger;
    }

    /**
     * Send a message.
     *
     * @param Message $message
     * @return void
     */
    public function sendMessage(Message $message)
    {
        if (!$message->isReadyForSent()) {
            throw new MessageException(__('mailing.message.fail.send', ['id' => $message->id]), 400);
        }

        if ($message->hasTemplate()) {
            $this->applyTemplate($message);
        }

        $messenger = new $this->messenger;

        $messenger->setMessage($message);

        Mail::send($messenger);
        
        $this->messageRepository->sendMessage($message);
    }

    /**
     * Creates the message content from your template.
     *
     * @param Message $message
     * @return void
     */    
    public function applyTemplate(Message $message)
    {
        if (empty($message->subject)) {
            $message->subject = $message->template->subject;
        }

        if (empty($message->content)) {
            $message->content = render(
                Blade::compileString($message->template->content), 
                json_decode($message->params, true)
            );
        }

        if ($message->isDirty()) {
            $message->save();
        }
    }
}