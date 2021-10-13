<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Enums\Billing\StudentStatusEnum;
use App\Models\Eloquent\Billing\Student\Student;

class StudentTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('student.index'));
        $this->assertAuthenticationRequired(route('student.store'), 'POST');
        $this->assertAuthenticationRequired(route('student.show', ['student' => 1]));
        $this->assertAuthenticationRequired(route('student.update', ['student' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('student.cancel', ['student' => 1]), 'DELETE');
    }

    public function test_student_index()
    {
        // Data creation
        $this->createMany(Student::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('student.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_student_store()
    {
        // Data creation
        $student = $this->makeOne(Student::class, true);
        $data = collect($student->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('student.store'), $student->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('student', $data->only(['user_id'])->toArray());
    }

    public function test_student_show()
    {
        // Data creation
        $student = $this->createOne(Student::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('student.show', ['student' => $student->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_student_update()
    {
        // Data creation
        $student = $this->createOne(Student::class, true);
        $newStudent = $this->makeOne(Student::class, true);
        $data = collect($newStudent->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(route('student.update', ['student' => $student->id]), $newStudent->toArray());

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('student', $data->only(['student_status_id'])->toArray());
    }

    public function test_student_cancel()
    {
        // Data creation
        $student = $this->createOne(Student::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('student.cancel', ['student' => $student->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('student', [
            'id' => $student->id,
            'student_status_id' => StudentStatusEnum::CANCELED
        ]);
    }
}