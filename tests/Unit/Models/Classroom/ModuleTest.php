<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\Module\Module;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class ModuleTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Module
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Module::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'module',
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

        $this->assertBelongsToManyRelation($relation, $this->model, 'module_x_student', 'module_id', 'student_id');
    }

    public function test_lessons_relation()
    {
        $relation = $this->model->lessons();

        $this->assertHasManyRelation($relation, $this->model, 'module_id');
    }

    public function test_course_relation()
    {
        $relation = $this->model->course();

        $this->assertBelongsToRelation($relation, $this->model, 'course_id');
    }

    public function test_test_relation()
    {
        $relation = $this->model->test();

        $this->assertBelongsToRelation($relation, $this->model, 'test_id');
    }
}