<?php

namespace App\Models\Mailing\MessageHeader;

use App\Models\Mailing\MessageTemplate\MessageTemplate;

trait MessageHeaderRelations
{
    /**
     * Message templates relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function templates()
    {
        return $this->hasMany(MessageTemplate::class, 'message_header_id');
    }
}