<?php

use App\Http\Controllers\System\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/languages', [LanguageController::class, 'index'])
    ->name('languages');
