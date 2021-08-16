<?php

namespace Tests\Unit\Model\Classroom;

use Tests\Unit\Models\ModelTestCase;
use App\Models\Classroom\CourseStatus;
use Tests\Unit\Models\HasFilterAsserts;
use Tests\Unit\Models\HasFactoryAsserts;

class CourseStatusTest extends ModelTestCase
{
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
