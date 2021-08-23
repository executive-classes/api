<?php

namespace App\Models\Eloquent\System\SystemAccessLog;

use App\Models\Eloquent\Billing\User\User;

trait SystemAccessLogRelations
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
     * Cross User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cross_user()
    {
        return $this->belongsTo(User::class, 'cross_user_id');
    }
}