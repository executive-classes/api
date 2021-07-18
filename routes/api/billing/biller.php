<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billling\BillerController;
use App\Http\Controllers\Billling\BillerStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/billers', [BillerController::class, 'index'])
    ->name('biller.index')
    ->middleware('can:' . UserPrivilegeEnum::BILLER_GET);

Route::post('/billers', [BillerController::class, 'store'])
    ->name('biller.store')
    ->middleware('can:' . UserPrivilegeEnum::BILLER_CREATE);

Route::get('/billers/status', [BillerStatusController::class, 'index'])
    ->name('biller.status.index')
    ->middleware('can:' . UserPrivilegeEnum::BILLER_GET);

Route::get('/billers/{biller}', [BillerController::class, 'show'])
    ->name('biller.show')
    ->middleware('can:' . UserPrivilegeEnum::BILLER_GET);

Route::put('/billers/{biller}', [BillerController::class, 'update'])
    ->name('biller.update')
    ->middleware('can:' . UserPrivilegeEnum::BILLER_UPDATE);

Route::delete('/billers/{biller}', [BillerController::class, 'cancel'])
    ->name('biller.cancel')
    ->middleware('can:' . UserPrivilegeEnum::BILLER_CANCEL);