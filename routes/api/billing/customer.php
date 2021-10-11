<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billing\CustomerController;
use App\Http\Controllers\Billing\CustomerStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customer.index')
    ->middleware('can:' . UserPrivilegeEnum::CUSTOMER_GET);

Route::post('/customers', [CustomerController::class, 'store'])
    ->name('customer.store')
    ->middleware('can:' . UserPrivilegeEnum::CUSTOMER_CREATE);

Route::get('/customers/status', [CustomerStatusController::class, 'index'])
    ->name('customer.status.index')
    ->middleware('can:' . UserPrivilegeEnum::CUSTOMER_GET);

Route::get('/customers/{customer}', [CustomerController::class, 'show'])
    ->name('customer.show')
    ->middleware('can:' . UserPrivilegeEnum::CUSTOMER_GET);

Route::put('/customers/{customer}', [CustomerController::class, 'update'])
    ->name('customer.update')
    ->middleware('can:' . UserPrivilegeEnum::CUSTOMER_UPDATE);

Route::delete('/customers/{customer}', [CustomerController::class, 'cancel'])
    ->name('customer.cancel')
    ->middleware('can:' . UserPrivilegeEnum::CUSTOMER_CANCEL);