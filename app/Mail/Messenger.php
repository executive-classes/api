<?php

namespace App\Mail;

use App\Exceptions\Mailing\MessageException;
use App\Models\Mailing\Message;
use App\Models\Mailing\MessageFooter;
use App\Models\Mailing\MessageHeader;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Messenger extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The instance of the Message.
     * 
     * @var Message
     */
    protected $message;

    /**
     * The content that will be sent.
     * 
     * @var string|null
     */
    public $content;

    /**
     * The header of the message.
     * 
     * @var MessageHeader|null
     */
    public $header;

    /**
     * The footer of the message.
     * 
     * @var MessageFooter|null
     */
    public $footer;

    /**
     * Get the sent data from a Message.
     *
     * @param Message $message
     * @return void
     */
    public function setMessage(Message $message)
    {
        if (empty($message->subject)) {
            throw new MessageException(__('mailing.message.fail.missing_subject', ['id' => $message->id]), 400);
        }

        if (empty($message->content)) {
            throw new MessageException(__('mailing.message.fail.missing_content', ['id' => $message->id]), 400);
        }

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
        $message = $this->from(env('MAIL_USERNAME'))
            ->replyTo($this->message->reply_to)
            ->to($this->message->to);

        if (isset($this->message->cc)) {
            $message->cc($this->message->cc);
        }

        if (isset($this->message->bcc)) {
            $message->bcc($this->message->bcc);
        }
            
        $message->subject($this->message->subject)->view('mailing.message');

        return $message;
    }
}
