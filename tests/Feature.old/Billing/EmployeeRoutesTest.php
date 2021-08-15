<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Models\Billing\Employee;
use App\Models\Billing\EmployeePosition;
use App\Models\Billing\EmployeeStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class EmployeeRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->getDevUser()->login();
        Employee::factory()->count(3)->create();
    }

    public function test_can_list_employees()
    {
        $response = $this->getJson(route('employee.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Employee::count(), 'data');
    }

    public function test_can_filter_employee_list()
    {
        $email = Employee::first()->user->email;
        $response = $this->getJson(route('employee.index', ['email' => $email]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Employee::email($email)->count(), 'data');
    }

    public function test_can_get_employee()
    {
        $id = Employee::first()->id;
        $response = $this->getJson(route('employee.show', ['employee' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
    }

    public function test_can_create_employee()
    {
        $data = Employee::factory()->make()->toArray();
        $response = $this->postJson(route('employee.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.user.id', $data['user_id']);
    }

    public function test_can_update_employee()
    {
        $data = [
            'employee_position_id' => EmployeePosition::inRandomOrder()->first()->id,
            'employee_status_id' => EmployeeStatus::where('id', '<>', EmployeeStatusEnum::CANCELED)
                ->inRandomOrder()
                ->first()
                ->id
        ];
        $id = Employee::first()->id;
        $response = $this->putJson(route('employee.update', ['employee' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.position.id', $data['employee_position_id']);
        $response->assertJsonPath('data.status.id', $data['employee_status_id']);
    }

    public function test_can_not_cancel_employee_by_update()
    {
        $data = ['employee_status_id' => EmployeeStatusEnum::CANCELED];
        $id = Employee::first()->id;
        $response = $this->putJson(route('employee.update', ['employee' => $id]), $data);

        $response->assertStatus(422);
    }

    public function test_can_cancel_employee()
    {
        $id = Employee::first()->id;
        $response = $this->deleteJson(route('employee.cancel', ['employee' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status.id', EmployeeStatusEnum::CANCELED);
    }
}
