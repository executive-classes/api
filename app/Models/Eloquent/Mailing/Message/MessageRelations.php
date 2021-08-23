<?php

namespace App\Models\Eloquent\Mailing\Message;

use App\Models\Eloquent\Mailing\MessageType\MessageType;
use App\Models\Eloquent\Mailing\MessageStatus\MessageStatus;
use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;

trait MessageRelations
{
    /**
     * Message status relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(MessageStatus::class, 'message_status_id');
    }

    /**
     * Message type relation by the message template.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function type()
    {
        return $this->hasOneThrough(MessageType::class, MessageTemplate::class);
    }

    /**
     * Message template relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(MessageTemplate::class, 'message_template_id', 'id');
    }
}