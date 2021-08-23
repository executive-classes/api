<?php

namespace App\Models\Eloquent\System\SystemAuditLog;

use App\Models\Eloquent\Billing\User\User;

trait SystemAuditLogRelations
{
    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cross_user()
    {
        return $this->belongsTo(User::class, 'cross_user_id');
    }
}