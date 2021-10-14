<?php

use Illuminate\Support\Facades\Route;
use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Classroom\TestController;

Route::get('/tests', [TestController::class, 'index'])
    ->name('test.index')
    ->middleware('can:' . UserPrivilegeEnum::TEST_GET);

Route::post('/tests', [TestController::class, 'store'])
    ->name('test.store')
    ->middleware('can:' . UserPrivilegeEnum::TEST_CREATE);

Route::get('/tests/{test}', [TestController::class, 'show'])
    ->name('test.show')
    ->middleware('can:' . UserPrivilegeEnum::TEST_GET);

Route::put('/tests/{test}', [TestController::class, 'update'])
    ->name('test.update')
    ->middleware('can:' . UserPrivilegeEnum::TEST_UPDATE);

Route::patch('/tests/{test}/reactivate', [TestController::class, 'reactivate'])
    ->name('test.reactivate')
    ->middleware('can:' . UserPrivilegeEnum::TEST_UPDATE);

Route::patch('/tests/{test}/cancel', [TestController::class, 'cancel'])
    ->name('test.cancel')
    ->middleware('can:' . UserPrivilegeEnum::TEST_UPDATE);