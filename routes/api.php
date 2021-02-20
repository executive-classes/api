<?php

use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () { return __('messages.welcome'); });

Route::post('/login', [AuthenticateController::class, 'login']);

Route::middleware(['auth:sanctum', 'lang'])->group(function () {
    Route::post('/login/cross', [AuthenticateController::class, 'crossLogin']);
    Route::get('/logout', [AuthenticateController::class, 'logout']);

    require("api/mailing/message.php");
    require("api/mailing/message_template.php");

});