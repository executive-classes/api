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

    // Auth
    require("api/auth/access_token.php");
    require("api/auth/cross_auth.php");

    // Billing
    require("api/billing/address.php");
    require("api/billing/biller.php");
    require("api/billing/country.php");
    require("api/billing/customer.php");
    require("api/billing/employee.php");
    require("api/billing/payment.php");
    require("api/billing/profile.php");
    require("api/billing/state.php");
    require("api/billing/student.php");
    require("api/billing/tax_type.php");
    require("api/billing/teacher.php");
    require("api/billing/user.php");

    // Classroom
    require("api/classroom/course.php");
    require("api/classroom/lesson.php");
    require("api/classroom/module.php");
    require("api/classroom/question.php");
    require("api/classroom/test.php");

    // General
    require("api/general/category.php");

    // Mailing
    require("api/mailing/message.php");
    require("api/mailing/message_template.php");

    // System
    require("api/system/buglog.php");
    require("api/system/language.php");
});