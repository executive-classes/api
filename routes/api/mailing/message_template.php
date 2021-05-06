<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Mailing\MessageTemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/messages_templates', [MessageTemplateController::class, 'list'])
    ->name('messages.templates.list')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_TEMPLATE_GET);

Route::get('/messages_templates/{messageTemplate}', [MessageTemplateController::class, 'show'])
    ->name('messages.templates.show')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_TEMPLATE_GET);

Route::post('/messages_templates', [MessageTemplateController::class, 'create'])
    ->name('messages.templates.create')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_TEMPLATE_CREATE);

Route::put('/messages_templates/{messageTemplate}', [MessageTemplateController::class, 'update'])
    ->name('messages.templates.update')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_TEMPLATE_UPDATE);

Route::delete('/messages_templates/{messageTemplate}', [MessageTemplateController::class, 'delete'])
    ->name('messages.templates.delete')
    ->middleware('can:' . UserPrivilegeEnum::MESSAGE_TEMPLATE_DELETE);