<?php

use App\Http\Controllers\Billling\TaxTypeController;
use Illuminate\Support\Facades\Route;

Route::get('/taxes', [TaxTypeController::class, 'index'])
    ->name('taxes');

Route::post('/taxes/validate', [TaxTypeController::class, 'validation'])
    ->name('taxes.validate');