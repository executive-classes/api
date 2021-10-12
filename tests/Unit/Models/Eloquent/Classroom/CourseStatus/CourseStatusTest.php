<?php

namespace Tests\Unit\Model\Classroom;

use Tests\Unit\Models\Eloquent\ModelTestCase;
use App\Models\Eloquent\Classroom\CourseStatus\CourseStatus;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CourseStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var CourseStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = CourseStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'course_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}
