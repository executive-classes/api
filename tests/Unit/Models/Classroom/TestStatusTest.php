<?php

namespace Tests\Unit\Models\Classroom;

use App\Models\Eloquent\Classroom\TestStatus\TestStatus;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class TestStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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