<?php

use App\Http\Controllers\Billling\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index');

Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');