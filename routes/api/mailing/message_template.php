<?php

use App\Http\Controllers\Mailing\MessageTemplateController;
use App\Models\Mailing\MessageTemplate;
use Illuminate\Support\Facades\Route;

Route::get('/messages_templates', [MessageTemplateController::class, 'list'])
    ->name('messages.templates.list');

Route::get('/messages_templates/{messageTemplate}', [MessageTemplateController::class, 'show'])
    ->name('messages.templates.show');

Route::post('/messages_templates', [MessageTemplateController::class, 'create'])
    ->name('messages.templates.create');

Route::put('/messages_templates/{messageTemplate}', [MessageTemplateController::class, 'update'])
    ->name('messages.templates.update');

Route::delete('/messages_templates/{messageTemplate}', [MessageTemplateController::class, 'delete'])
    ->name('messages.templates.delete');