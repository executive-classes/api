<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Classroom\Course;
use Tests\Unit\Models\ModelTestCase;

class CourseTest extends ModelTestCase
{
    /**
     * @var Course
     */
    protected $model;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->model = new Course();
    }

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'course',
            'primaryKey' => 'id',
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

    public function test_students_relation()
    {
        $relation = $this->model->students();

        $this->assertBelongsToManyRelation($relation, $this->model, 'course_x_student', 'course_id', 'student_id');
    }

    public function test_modules_relation()
    {
        $relation = $this->model->modules();

        $this->assertHasManyRelation($relation, $this->model, 'course_id');
    }

    public function test_lessons_relation()
    {
        $relation = $this->model->lessons();

        $this->assertHasManyRelation($relation, $this->model, 'course_id');
    }

    public function test_test_relation()
    {
        $relation = $this->model->test();

        $this->assertBelongsToRelation($relation, $this->model, 'test_id');
    }
}
