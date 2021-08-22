<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Classroom\Question\Question;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class QuestionTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Question
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Question::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'question',
            'fillable' => [
                'name',
                'question',
                'active',
                'category_id'
            ],
            'casts' => [
                'id' => 'int',
                'active' => 'boolean'
            ],
        ]);
    }

    public function test_category_relation()
    {
        $relation = $this->model->category();

        $this->assertBelongsToRelation($relation, $this->model, 'category_id');
    }
    
    public function test_test_students_relation()
    {
        $relation = $this->model->testStudents();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_question_x_student', 'question_id', 'student_id');
    }

    public function test_lesson_students_relation()
    {
        $relation = $this->model->lessonStudents();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_question_x_student', 'question_id', 'student_id');
    }

    public function test_test_teachers_relation()
    {
        $relation = $this->model->testTeachers();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_question_x_student', 'question_id', 'teacher_id');
    }

    public function test_lesson_teachers_relation()
    {
        $relation = $this->model->lessonTeachers();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_question_x_student', 'question_id', 'teacher_id');
    }

    public function test_lessons_relation()
    {
        $relation = $this->model->lessons();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_question', 'question_id', 'lesson_id');
    }

    public function test_tests_relation()
    {
        $relation = $this->model->tests();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_x_question', 'question_id', 'test_id');
    }
}