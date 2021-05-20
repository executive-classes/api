<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Billling\AddressController;

Route::get('/addresses', [AddressController::class, 'index'])
    ->name('address.index')
    ->middleware('can:' . UserPrivilegeEnum::ADDRESS_GET);

Route::post('/addresses', [AddressController::class, 'store'])
    ->name('address.store')
    ->middleware('can:' . UserPrivilegeEnum::ADDRESS_CREATE);

Route::get('/addresses/{address}', [AddressController::class, 'show'])
    ->name('address.show')
    ->middleware('can:' . UserPrivilegeEnum::ADDRESS_GET);

Route::put('/addresses/{address}', [AddressController::class, 'update'])
    ->name('address.update')
    ->middleware('can:' . UserPrivilegeEnum::ADDRESS_UPDATE);

Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])
    ->name('address.destroy')
    ->middleware('can:' . UserPrivilegeEnum::ADDRESS_DELETE);