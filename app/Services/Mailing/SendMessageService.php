<?php

namespace App\Services\Mailing;

use App\Mail\Messenger;
use App\Models\Mailing\Message;
use App\Repositories\Mailing\MessageRepository;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Mail;

class SendMessageService
{
    /**
     * The Message Repository
     */
    protected MessageRepository $messageRepository;

    /**
     * Creates a Send Message Service
     *
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository) {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Send a message.
     *
     * @param Message $message
     * @return void
     */
    public function sendMessage(Message $message)
    {
        $this->renderTemplate($message);
        Mail::send(new Messenger($message));
        // $this->messageRepository->sendMessage($message);
    }

    /**
     * Creates the message content from your template.
     *
     * @param Message $message
     * @return void
     */    
    protected function renderTemplate(Message $message)
    {
        if ($message->hasTemplate()) {
            $message->content = render(
                Blade::compileString($message->template->content), 
                json_decode($message->params, true)
            );

            $message->save();
        }
    }
}