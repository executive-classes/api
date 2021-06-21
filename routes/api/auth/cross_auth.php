<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::post('/login/cross', [AuthenticateController::class, 'crossLogin'])
    ->name('login.cross')
    ->middleware('can:' . UserPrivilegeEnum::CROSS_AUTH);