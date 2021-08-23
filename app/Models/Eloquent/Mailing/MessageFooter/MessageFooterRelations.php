<?php

namespace App\Models\Eloquent\Mailing\MessageFooter;

use App\Models\Eloquent\Mailing\MessageTemplate\MessageTemplate;

trait MessageFooterRelations
{
    /**
     * Message templates relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function templates()
    {
        return $this->hasMany(MessageTemplate::class, 'message_footer_id');
    }
}