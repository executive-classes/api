<?php

namespace App\Mail;

use App\Models\Mailing\Message;
use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use App\Models\Mailing\MessageTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Messenger extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The instance of the Message.
     */
    protected Message $message;

    /**
     * The content that will be sent.
     */
    public string $content;

    /**
     * The header of the message.
     */
    public MessageHeader $header;

    /**
     * The footer of the message.
     */
    public MessageFooter $footer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->content = $message->content;
        $this->header = $message->template->header ?? null;
        $this->footer = $message->template->footer ?? null;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->message->reply_to)
            ->to($this->message->to)
            ->cc($this->message->cc)
            ->bcc($this->message->bcc)
            ->subject($this->message->subject)
            ->view('mailing.message');
    }
}
