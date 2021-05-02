<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Test Routes
|--------------------------------------------------------------------------
|
| The routes that are used for running system tests.
|
*/

Route::get('/', function () { 
    return response('', 200); 
});

Route::get('/error', function () {
    throw new Exception("Error", 500);
});