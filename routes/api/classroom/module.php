<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Classroom\ModuleController;

Route::get('/modules', [ModuleController::class, 'index'])
    ->name('module.index')
    ->middleware('can:' . UserPrivilegeEnum::MODULE_GET);

Route::post('/modules', [ModuleController::class, 'store'])
    ->name('module.store')
    ->middleware('can:' . UserPrivilegeEnum::MODULE_CREATE);

Route::get('/modules/{module}', [ModuleController::class, 'show'])
    ->name('module.show')
    ->middleware('can:' . UserPrivilegeEnum::MODULE_GET);

Route::put('/modules/{module}', [ModuleController::class, 'update'])
    ->name('module.update')
    ->middleware('can:' . UserPrivilegeEnum::MODULE_UPDATE);

Route::patch('/modules/{module}/reactivate', [ModuleController::class, 'reactivate'])
    ->name('module.reactivate')
    ->middleware('can:' . UserPrivilegeEnum::MODULE_UPDATE);

Route::patch('/modules/{module}/cancel', [ModuleController::class, 'cancel'])
    ->name('module.cancel')
    ->middleware('can:' . UserPrivilegeEnum::MODULE_UPDATE);