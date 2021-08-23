<?php

namespace App\Models\Observers;

use App\Services\System\AuditLogService;
use Illuminate\Database\Eloquent\Model;

class AuditObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /**
     * Handle the User "created" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function created(Model $model)
    {
        AuditLogService::insert(request(), $model);
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function updated(Model $model)
    {
        AuditLogService::update(request(), $model);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function deleted(Model $model)
    {
        AuditLogService::delete(request(), $model);
    }
}
