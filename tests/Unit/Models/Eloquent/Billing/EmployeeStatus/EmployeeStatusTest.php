<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\EmployeeStatus\EmployeeStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class EmployeeStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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