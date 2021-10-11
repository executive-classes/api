<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billing\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index'])
    ->name('user.index')
    ->middleware('can:' . UserPrivilegeEnum::USER_GET);

Route::post('/users', [UserController::class, 'store'])
    ->name('user.store')
    ->middleware('can:' . UserPrivilegeEnum::USER_CREATE);

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('user.show')
    ->middleware('can:' . UserPrivilegeEnum::USER_GET);

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('user.update')
    ->middleware('can:' . UserPrivilegeEnum::USER_UPDATE);

Route::delete('/users/{user}', [UserController::class, 'cancel'])
    ->name('user.cancel')
    ->middleware('can:' . UserPrivilegeEnum::USER_CANCEL);