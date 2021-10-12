<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\Course\Course;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CourseTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;
    
    /**
     * @var Course
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Course::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'course',
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
}
