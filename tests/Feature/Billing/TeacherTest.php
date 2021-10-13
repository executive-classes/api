<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Enums\Billing\TeacherStatusEnum;
use App\Models\Eloquent\Billing\Teacher\Teacher;

class TeacherTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('teacher.index'));
        $this->assertAuthenticationRequired(route('teacher.store'), 'POST');
        $this->assertAuthenticationRequired(route('teacher.show', ['teacher' => 1]));
        $this->assertAuthenticationRequired(route('teacher.update', ['teacher' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('teacher.cancel', ['teacher' => 1]), 'DELETE');
    }

    public function test_teacher_index()
    {
        // Data creation
        $this->createMany(Teacher::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('teacher.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_teacher_store()
    {
        // Data creation
        $teacher = $this->makeOne(Teacher::class, true);
        $data = collect($teacher->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('teacher.store'), $teacher->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('teacher', $data->only(['user_id'])->toArray());
    }

    public function test_teacher_show()
    {
        // Data creation
        $teacher = $this->createOne(Teacher::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('teacher.show', ['teacher' => $teacher->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_teacher_update()
    {
        // Data creation
        $teacher = $this->createOne(Teacher::class, true);
        $newEmployee = $this->makeOne(Teacher::class, true);
        $data = collect($newEmployee->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(route('teacher.update', ['teacher' => $teacher->id]), $newEmployee->toArray());

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('teacher', $data->only(['teacher_status_id'])->toArray());
    }

    public function test_teacher_cancel()
    {
        // Data creation
        $teacher = $this->createOne(Teacher::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('teacher.cancel', ['teacher' => $teacher->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('teacher', [
            'id' => $teacher->id,
            'teacher_status_id' => TeacherStatusEnum::CANCELED
        ]);
    }
}