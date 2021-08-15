<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\General\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('category.index')
    ->middleware('can:' . UserPrivilegeEnum::CATEGORY_GET);

Route::post('/categories', [CategoryController::class, 'store'])
    ->name('category.store')
    ->middleware('can:' . UserPrivilegeEnum::CATEGORY_CREATE);

Route::get('/categories/{category}', [CategoryController::class, 'show'])
    ->name('category.show')
    ->middleware('can:' . UserPrivilegeEnum::CATEGORY_GET);

Route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->name('category.update')
    ->middleware('can:' . UserPrivilegeEnum::CATEGORY_UPDATE);

Route::delete('/categories/{category}', [CategoryController::class, 'delete'])
    ->name('category.delete')
    ->middleware('can:' . UserPrivilegeEnum::CATEGORY_DELETE);
