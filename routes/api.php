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
| is assigned the "api" middleware group. Enjoy address your API!
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

    // Billing
    require("api/billing/address.php");
    require("api/billing/biller.php");
    require("api/billing/customer.php");
    require("api/billing/employee.php");
    require("api/billing/profile.php");
    require("api/billing/student.php");
    require("api/billing/teacher.php");
    require("api/billing/user.php");

    // Mailing
    require("api/mailing/message.php");
    require("api/mailing/message_template.php");

    // System
    require("api/system/buglog.php");
});