<?php

namespace App\Http\Controllers\Classroom;

use App\Models\Eloquent\Classroom\Question\QuestionFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\Classroom\Question\CreateQuestionRequest;
use App\Http\Requests\Classroom\Question\UpdateQuestionRequest;
use App\Http\Resources\Classroom\Question\QuestionCollection;
use App\Http\Resources\Classroom\Question\QuestionResource;
use App\Models\Eloquent\Classroom\Question\Question;

class QuestionController extends Controller
{
    public function index(QuestionFilters $filter)
    {
        return new QuestionCollection(Question::filter($filter)->get());
    }

    public function store(CreateQuestionRequest $request)
    {
        $question = new Question($request->validated());
        $question->save();

        return new QuestionResource($question);
    }

    public function show(Question $question)
    {
        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->fill($request->validated());
        $question->update();

        return new QuestionResource($question);
    }

    public function reactivate(Question $question)
    {
        $question->active = true;
        $question->update();

        return new QuestionResource($question);
    }

    public function cancel(Question $question)
    {
        $question->active = false;
        $question->update();

        return new QuestionResource($question);
    }
}