<?php

namespace App\Models\System\SystemBugLog;

use App\Models\System\SystemApp\SystemApp;
use App\Models\Billing\User\User;

trait SystemBugLogRelations
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

    /**
     * System App relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function app()
    {
        return $this->belongsTo(SystemApp::class, 'app_id');
    }
}