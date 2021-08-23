<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\Student\Student;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class StudentTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Student
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Student::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'student',
            'fillable' => [
                'customer_id',
                'biller_id',
                'user_id',
                'student_status_id'
            ]
        ]);
    }

    public function test_user_relation()
    {
        $relation = $this->model->user();

        $this->assertBelongsToRelation($relation, $this->model, 'user_id');
    }

    public function test_customer_relation()
    {
        $relation = $this->model->customer();

        $this->assertBelongsToRelation($relation, $this->model, 'customer_id');
    }

    public function test_biller_relation()
    {
        $relation = $this->model->biller();

        $this->assertBelongsToRelation($relation, $this->model, 'biller_id');
    }

    public function test_status_relation()
    {
        $relation = $this->model->status();

        $this->assertBelongsToRelation($relation, $this->model, 'student_status_id');
    }

    public function test_teachers_relation()
    {
        $relation = $this->model->teachers();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_student', 'student_id', 'teacher_id');
    }

    public function test_lessons_relation()
    {
        $relation = $this->model->lessons();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_student', 'student_id', 'lesson_id');
    }

    public function test_modules_relation()
    {
        $relation = $this->model->modules();

        $this->assertBelongsToManyRelation($relation, $this->model, 'module_x_student', 'student_id', 'module_id');
    }

    public function test_courses_relation()
    {
        $relation = $this->model->courses();

        $this->assertBelongsToManyRelation($relation, $this->model, 'course_x_student', 'student_id', 'course_id');
    }

    public function test_lesson_questions_relation()
    {
        $relation = $this->model->lessonQuestions();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lessonQuestion_x_student', 'student_id', 'question_id');
    }

    public function test_test_questions_relation()
    {
        $relation = $this->model->testQuestions();

        $this->assertBelongsToManyRelation($relation, $this->model, 'testQuestion_x_student', 'student_id', 'question_id');
    }

    public function test_tests_relation()
    {
        $relation = $this->model->tests();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_x_student', 'student_id', 'test_id');
    }

    public function test_email_scope()
    {
        $this->assertModelScope($this->model, 'email');
    }

    public function test_privileges_function()
    {
        $this->assertHasMethod(Student::class, 'privileges');
    }
}