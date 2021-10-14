<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Controllers\Classroom\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/questions', [QuestionController::class, 'index'])
    ->name('question.index')
    ->middleware('can:' . UserPrivilegeEnum::QUESTION_GET);

Route::post('/questions', [QuestionController::class, 'store'])
    ->name('question.store')
    ->middleware('can:' . UserPrivilegeEnum::QUESTION_CREATE);

Route::get('/questions/{question}', [QuestionController::class, 'show'])
    ->name('question.show')
    ->middleware('can:' . UserPrivilegeEnum::QUESTION_GET);

Route::put('/questions/{question}', [QuestionController::class, 'update'])
    ->name('question.update')
    ->middleware('can:' . UserPrivilegeEnum::QUESTION_UPDATE);

Route::patch('/questions/{question}/reactivate', [QuestionController::class, 'reactivate'])
    ->name('question.reactivate')
    ->middleware('can:' . UserPrivilegeEnum::QUESTION_UPDATE);

Route::patch('/questions/{question}/cancel', [QuestionController::class, 'cancel'])
    ->name('question.cancel')
    ->middleware('can:' . UserPrivilegeEnum::QUESTION_UPDATE);