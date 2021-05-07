<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Mailing\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/messages', [MessageController::class, 'list'])
    ->name('messages.list')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_GET);
    
Route::get('/messages/{message}', [MessageController::class, 'show'])
    ->name('messages.show')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_GET);

Route::post('/messages', [MessageController::class, 'create'])
    ->name('messages.create')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_CREATE);

Route::delete('/messages/{message}', [MessageController::class, 'cancel'])
    ->name('messages.cancel')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_CANCEL);