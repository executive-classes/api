<?php

use App\Http\Controllers\Mailing\MessageController;
use Illuminate\Support\Facades\Route;

Route::get('/messages', [MessageController::class, 'list'])
    ->name('messages.list');
    
Route::get('/messages/{message}', [MessageController::class, 'show'])
    ->name('messages.show');

Route::post('/messages', [MessageController::class, 'create'])
    ->name('messages.create');

Route::patch('/messages/{message}/cancel', [MessageController::class, 'cancel'])
    ->name('messages.cancel');

Route::delete('/messages/{message}', [MessageController::class, 'delete'])
    ->name('messages.show');