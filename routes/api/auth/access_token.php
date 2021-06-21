<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

Route::get('/token', [AuthenticateController::class, 'token'])
    ->name('token.show');