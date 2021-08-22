<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\EmployeeStatus\EmployeeStatus;
use Tests\Unit\Models\ModelTestCase;

class EmployeeStatusTest extends ModelTestCase
{
    /**
     * @var EmployeeStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = EmployeeStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'employee_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}