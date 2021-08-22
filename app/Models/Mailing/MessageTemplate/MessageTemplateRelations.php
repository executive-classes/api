<?php

namespace App\Models\Mailing\MessageTemplate;

use App\Models\Mailing\MessageType\MessageType;
use App\Models\Mailing\Message\Message;
use App\Models\Mailing\MessageFooter\MessageFooter;
use App\Models\Mailing\MessageHeader\MessageHeader;

trait MessageTemplateRelations
{
    /**
     * Message type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(MessageType::class, 'message_type_id');
    }

    /**
     * Message header relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function header()
    {
        return $this->belongsTo(MessageHeader::class, 'message_header_id');
    }

    /**
     * Message footer relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function footer()
    {
        return $this->belongsTo(MessageFooter::class, 'message_footer_id');
    }

    /**
     * Message relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class, 'message_template_id');
    }
}