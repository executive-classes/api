<?php

use App\Http\Controllers\Billling\PaymentIntervalController;
use App\Http\Controllers\Billling\PaymentMethodControler;
use Illuminate\Support\Facades\Route;

Route::prefix('/payments')->group(function () {
    
    Route::get('/intervals', [PaymentIntervalController::class, 'index'])
        ->name('payments.interval.index');

    Route::get('/methods', [PaymentMethodControler::class, 'index'])
        ->name('payments.methods.index');
    
});