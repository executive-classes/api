<?php

namespace App\Traits\Models\Mailing;

use App\Models\Mailing\MessageStatus;
use Carbon\Carbon;

trait MessageVerifications
{
    /**
     * Verify if this message has a template.
     *
     * @return boolean
     */
    public function hasTemplate(): bool
    {
        return $this->template !== null;
    }

    /**
     * Determine if this message was sent.
     *
     * @return boolean
     */
    public function wasSent()
    {
        return $this->message_status_id === MessageStatus::SENT;
    }

    /**
     * Determine if this message was canceled.
     *
     * @return boolean
     */
    public function isScheduled()
    {
        return $this->message_status_id === MessageStatus::SCHEDULED;
    }

    /**
     * Determine if this message was canceled.
     *
     * @return boolean
     */
    public function wasCanceled()
    {
        return $this->message_status_id === MessageStatus::CANCELED;
    }

    /**
     * Determine if the message is ready for sent.
     *
     * @return boolean
     */
    public function isReadyForSent()
    {
        return $this->message_status_id === MessageStatus::SCHEDULED
            && $this->should_proccess_at <= Carbon::now()->toDateTimeString();
    }
}