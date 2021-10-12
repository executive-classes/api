<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\Lesson\Lesson;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class LessonTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Lesson
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Lesson::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'lesson',
            'fillable' => [
                'name',
                'active',
                'category_id'
            ],
            'casts' => [
                'id' => 'int',
                'active' => 'boolean'
            ]
        ]);
    }

    public function test_category_relation()
    {
        $relation = $this->model->category();

        $this->assertBelongsToRelation($relation, $this->model, 'category_id');
    }

    public function test_students_relation()
    {
        $relation = $this->model->students();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_student', 'lesson_id', 'student_id');
    }

    public function test_teachers_relation()
    {
        $relation = $this->model->teachers();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_teacher', 'lesson_id', 'teacher_id');
    }

    public function test_course_relation()
    {
        $relation = $this->model->course();

        $this->assertBelongsToRelation($relation, $this->model, 'course_id');
    }

    public function test_module_relation()
    {
        $relation = $this->model->module();

        $this->assertBelongsToRelation($relation, $this->model, 'module_id');
    }

    public function test_questions_relation()
    {
        $relation = $this->model->questions();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_question', 'lesson_id', 'question_id');
    }

    public function test_materials_relation()
    {
        $relation = $this->model->materials();

        $this->assertBelongsToManyRelation($relation, $this->model, 'lesson_x_material', 'lesson_id', 'material_id');
    }
}