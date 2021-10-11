<?php

use App\Http\Controllers\Billing\AddressStateController;
use Illuminate\Support\Facades\Route;

Route::get('/states', [AddressStateController::class, 'index'])
    ->name('state.index');
