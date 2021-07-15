<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\StudentStatusEnum;
use App\Models\Billing\Student;
use App\Models\Billing\StudentStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class StudentRoutesTest extends TestCase
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
        Student::factory()->count(3)->create();
    }

    public function test_can_list_students()
    {
        $response = $this->getJson(route('student.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Student::count(), 'data');
    }

    public function test_can_filter_student_list()
    {
        $email = Student::first()->user->email;
        $response = $this->getJson(route('student.index', ['email' => $email]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Student::email($email)->count(), 'data');
    }

    public function test_can_get_student()
    {
        $id = Student::first()->id;
        $response = $this->getJson(route('student.show', ['student' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
    }

    public function test_can_create_student()
    {
        $data = Student::factory()->make()->toArray();
        $response = $this->postJson(route('student.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.user.id', $data['user_id']);
    }

    public function test_can_update_student()
    {
        $data = [
            'student_status_id' => StudentStatus::where('id', '<>', StudentStatusEnum::CANCELED)
                ->inRandomOrder()
                ->first()
                ->id
        ];
        $id = Student::first()->id;
        $response = $this->putJson(route('student.update', ['student' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status.id', $data['student_status_id']);
    }

    public function test_can_not_cancel_student_by_update()
    {
        $data = ['student_status_id' => StudentStatusEnum::CANCELED];
        $id = Student::first()->id;
        $response = $this->putJson(route('student.update', ['student' => $id]), $data);

        $response->assertStatus(422);
    }

    public function test_can_cancel_student()
    {
        $id = Student::first()->id;
        $response = $this->deleteJson(route('student.cancel', ['student' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status.id', StudentStatusEnum::CANCELED);
    }
}
