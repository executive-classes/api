<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Enums\Billing\TeacherStatusEnum;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;
use App\Models\Eloquent\Billing\Teacher\Teacher;

class TeacherTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Teacher
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Teacher::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'teacher',
            'attributes' => [
                'teacher_status_id' => TeacherStatusEnum::ACTIVE
            ],
            'fillable' => [
                'user_id',
                'teacher_status_id'
            ]
        ]);
    }

    public function test_user_relation()
    {
        $relation = $this->model->user();

        $this->assertBelongsToRelation($relation, $this->model, 'user_id');
    }

    public function test_status_relation()
    {
        $relation = $this->model->status();

        $this->assertBelongsToRelation($relation, $this->model, 'teacher_status_id');
    }

    public function test_students_relation()
    {
        $relation = $this->model->students();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_student', 'teacher_id', 'student_id');
    }

    public function test_lessons_relation()
    {
        $relation = $this->model->lessons();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_student', 'teacher_id', 'lesson_id');
    }

    public function test_lesson_questions_relation()
    {
        $relation = $this->model->lessonQuestions();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lessonQuestion_x_student', 'teacher_id', 'question_id');
    }

    public function test_test_questions_relation()
    {
        $relation = $this->model->testQuestions();

        $this->assertBelongsToManyRelation($relation, $this->model, 'testQuestion_x_student', 'teacher_id', 'question_id');
    }

    public function test_tests_relation()
    {
        $relation = $this->model->tests();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_x_student', 'teacher_id', 'test_id');
    }
    
    public function test_email_scope()
    {
        $this->assertModelScope($this->model, 'email');
    }

    public function test_privileges_function()
    {
        $this->assertHasMethod(Teacher::class, 'privileges');
    }
}