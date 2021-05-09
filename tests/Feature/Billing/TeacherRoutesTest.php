<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Billing\Teacher;
use App\Models\Billing\TeacherStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class TeacherRoutesTest extends TestCase
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
        Teacher::factory()->count(3)->create();
    }

    public function test_can_list_employees()
    {
        $response = $this->getJson(route('teacher.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Teacher::count(), 'data');
    }

    public function test_can_filter_employee_list()
    {
        $email = Teacher::first()->user->email;
        $response = $this->getJson(route('teacher.index', ['email' => $email]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Teacher::email($email)->count(), 'data');
    }

    public function test_can_get_employee()
    {
        $id = Teacher::first()->id;
        $response = $this->getJson(route('teacher.show', ['teacher' => $id]));

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
        $data = Teacher::factory()->make()->toArray();
        $response = $this->postJson(route('teacher.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.user_id', $data['user_id']);
    }

    public function test_can_update_employee()
    {
        $data = [
            'teacher_status_id' => TeacherStatus::where('id', '<>', TeacherStatusEnum::CANCELED)
                ->inRandomOrder()
                ->first()
                ->id
        ];
        $id = Teacher::first()->id;
        $response = $this->putJson(route('teacher.update', ['teacher' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status_id', $data['teacher_status_id']);
    }

    public function test_can_not_cancel_employee_by_update()
    {
        $data = ['teacher_status_id' => TeacherStatusEnum::CANCELED];
        $id = Teacher::first()->id;
        $response = $this->putJson(route('teacher.update', ['teacher' => $id]), $data);

        $response->assertStatus(422);
    }

    public function test_can_cancel_employee()
    {
        $id = Teacher::first()->id;
        $response = $this->deleteJson(route('teacher.cancel', ['teacher' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status_id', TeacherStatusEnum::CANCELED);
        
    }

    
}
