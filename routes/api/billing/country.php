<?php

use App\Http\Controllers\Billling\AddressCountryController;
use Illuminate\Support\Facades\Route;

Route::get('/countries', [AddressCountryController::class, 'index'])
    ->name('country.index');
