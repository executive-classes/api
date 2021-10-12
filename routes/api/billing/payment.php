<?php

use App\Http\Controllers\Billing\PaymentIntervalController;
use App\Http\Controllers\Billing\PaymentMethodController;
use Illuminate\Support\Facades\Route;

Route::prefix('/payments')->group(function () {
    
    Route::get('/intervals', [PaymentIntervalController::class, 'index'])
        ->name('payments.interval.index');

    Route::get('/methods', [PaymentMethodController::class, 'index'])
        ->name('payments.methods.index');
    
});