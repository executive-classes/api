<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\Employee;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Models\HasFilterAsserts;
use Tests\Unit\Models\HasFactoryAsserts;

class EmployeeTest extends ModelTestCase
{
    use HasFactoryAsserts, HasFilterAsserts;
    
    /**
     * @var Employee
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Employee::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'employee',
            'fillable' => [
                'employee_status_id',
                'employee_position_id'
            ]
        ]);
    }

    public function test_user_relation()
    {
        $relation = $this->model->user();

        $this->assertBelongsToRelation($relation, $this->model, 'user_id');
    }

    public function test_status_relation()
    {
        $relation = $this->model->status();

        $this->assertBelongsToRelation($relation, $this->model, 'employee_status_id');
    }

    public function test_position_relation()
    {
        $relation = $this->model->position();

        $this->assertBelongsToRelation($relation, $this->model, 'employee_position_id');
    }

    public function test_email_scope()
    {
        $this->assertModelScope($this->model, 'email');
    }
}