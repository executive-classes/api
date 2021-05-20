<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\System\BugLogController;
use Illuminate\Support\Facades\Route;

Route::get('/logs/bugs', [BugLogController::class, 'index'])
    ->name('logs.bugs.index')
    ->middleware('can:' . UserPrivilegeEnum::BUG_LOG_GET);
