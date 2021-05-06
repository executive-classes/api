<?php

use App\Enums\Billing\UserPrivilegeEnum;
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

Route::get('/', function () { return __('messages.welcome'); })
    ->name('welcome');

Route::post('/login', [AuthenticateController::class, 'login'])
    ->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticateController::class, 'logout'])
        ->name('logout');

    Route::post('/login/cross', [AuthenticateController::class, 'crossLogin'])
        ->name('login.cross')
        ->middleware('can:' . UserPrivilegeEnum::CROSS_AUTH);

    require("api/billing/profile.php");
    require("api/billing/user.php");
    require("api/mailing/message.php");
    require("api/mailing/message_template.php");
});