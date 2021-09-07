<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\EmployeePosition\EmployeePosition;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class EmployeePositionTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var EmployeePosition
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = EmployeePosition::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'employee_position',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }

    public function test_privileges_relation()
    {
        $relation = $this->model->privileges();

        $this->assertBelongsToManyRelation($relation, $this->model, 'privilege_x_position', 'position_id', 'privilege_id');
    }

    public function test_employees_relation()
    {
        $relation = $this->model->employees();

        $this->assertHasManyRelation($relation, $this->model, 'employee_position_id');
    }

    public function test_parent_relation()
    {
        $relation = $this->model->parent();

        $this->assertBelongsToRelation($relation, $this->model, 'parent_id');
    }

    public function test_children_relation()
    {
        $relation = $this->model->children();

        $this->assertHasManyRelation($relation, $this->model, 'parent_id');
    }
}