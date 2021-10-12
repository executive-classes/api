<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class StudentStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var StudentStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = StudentStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'student_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}