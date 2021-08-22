<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\StudentStatus\StudentStatus;
use Tests\Unit\Models\ModelTestCase;

class StudentStatusTest extends ModelTestCase
{
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