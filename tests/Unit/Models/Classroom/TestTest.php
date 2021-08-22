<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Classroom\Test\Test;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class TestTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Test
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Test::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'test',
            'fillable' => [
                'name',
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

    public function test_courses_relation()
    {
        $relation = $this->model->courses();

        $this->assertHasManyRelation($relation, $this->model, 'test_id');
    }

    public function test_module_relation()
    {
        $relation = $this->model->module();

        $this->assertHasManyRelation($relation, $this->model, 'test_id');
    }

    public function test_students_relation()
    {
        $relation = $this->model->students();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_x_student', 'test_id', 'student_id');
    }

    public function test_teachers_relation()
    {
        $relation = $this->model->teachers();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_x_student', 'test_id', 'teacher_id');
    }

    public function test_questions_relation()
    {
        $relation = $this->model->questions();

        $this->assertBelongsToManyRelation($relation, $this->model, 'test_x_question', 'test_id', 'question_id');
    }
}