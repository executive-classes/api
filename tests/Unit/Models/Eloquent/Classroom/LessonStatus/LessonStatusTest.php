<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\LessonStatus\LessonStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class LessonStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var LessonStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = LessonStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'lesson_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}