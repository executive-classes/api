<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Classroom\MaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/materials', [MaterialController::class, 'index'])
    ->name('material.index')
    ->middleware('can:' . UserPrivilegeEnum::MATERIAL_GET);

Route::post('/materials', [MaterialController::class, 'store'])
    ->name('material.store')
    ->middleware('can:' . UserPrivilegeEnum::MATERIAL_CREATE);

Route::get('/materials/{material}', [MaterialController::class, 'show'])
    ->name('material.show')
    ->middleware('can:' . UserPrivilegeEnum::MATERIAL_GET);

Route::put('/materials/{material}', [MaterialController::class, 'update'])
    ->name('material.update')
    ->middleware('can:' . UserPrivilegeEnum::MATERIAL_UPDATE);

Route::patch('/materials/{material}/reactivate', [MaterialController::class, 'reactivate'])
    ->name('material.reactivate')
    ->middleware('can:' . UserPrivilegeEnum::MATERIAL_UPDATE);

Route::patch('/materials/{material}/cancel', [MaterialController::class, 'cancel'])
    ->name('material.cancel')
    ->middleware('can:' . UserPrivilegeEnum::MATERIAL_UPDATE);