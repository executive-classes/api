<?php

namespace Tests\Unit\Models\Classroom;

use App\Models\Eloquent\Classroom\TestStatus\TestStatus;
use Tests\Unit\Models\ModelTestCase;

class TestStatusTest extends ModelTestCase
{
    /**
     * @var TestStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = TestStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'test_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}