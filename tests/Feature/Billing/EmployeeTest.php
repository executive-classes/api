<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Eloquent\Billing\Employee\Employee;

class EmployeeTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('employee.index'));
        $this->assertAuthenticationRequired(route('employee.store'), 'POST');
        $this->assertAuthenticationRequired(route('employee.show', ['employee' => 1]));
        $this->assertAuthenticationRequired(route('employee.update', ['employee' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('employee.cancel', ['employee' => 1]), 'DELETE');
    }

    public function test_employee_index()
    {
        // Data creation
        $this->createMany(Employee::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('employee.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_employee_store()
    {
        // Data creation
        $employee = $this->makeOne(Employee::class, true);
        $data = collect($employee->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('employee.store'), $employee->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('employee', $data->only(['employee_position_id', 'user_id'])->toArray());
    }

    public function test_employee_show()
    {
        // Data creation
        $employee = $this->createOne(Employee::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('employee.show', ['employee' => $employee->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_employee_update()
    {
        // Data creation
        $employee = $this->createOne(Employee::class, true);
        $newEmployee = $this->makeOne(Employee::class, true);
        $data = collect($newEmployee->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(route('employee.update', ['employee' => $employee->id]), $newEmployee->toArray());

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('employee', $data->only(['employee_position_id', 'employee_status_id'])->toArray());
    }

    public function test_employee_cancel()
    {
        // Data creation
        $employee = $this->createOne(Employee::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('employee.cancel', ['employee' => $employee->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('employee', [
            'id' => $employee->id,
            'employee_status_id' => EmployeeStatusEnum::CANCELED
        ]);
    }
}