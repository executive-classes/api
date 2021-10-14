<?php

namespace Tests\Feature\Classroom;

use App\Models\Eloquent\Classroom\Lesson\Lesson;
use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;

class LessonTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('lesson.index'));
        $this->assertAuthenticationRequired(route('lesson.store'), 'POST');
        $this->assertAuthenticationRequired(route('lesson.show', ['lesson' => 1]));
        $this->assertAuthenticationRequired(route('lesson.update', ['lesson' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('lesson.reactivate', ['lesson' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('lesson.cancel', ['lesson' => 1]), 'PATCH');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('lesson.index'));
        
        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $lesson = $this->makeOne(Lesson::class, true);
        $data = collect($lesson->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('lesson.store'), $lesson->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('lesson', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $lesson = $this->createOne(Lesson::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('lesson.show', ['lesson' => $lesson->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $lesson = $this->createOne(Lesson::class);
        $newLesson = $this->makeOne(Lesson::class, true);
        $data = collect($newLesson->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('lesson.update', ['lesson' => $lesson->id]),
                $newLesson->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('lesson', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_reactivate()
    {
        // Data creation
        $lesson = $this->createOne(Lesson::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('lesson.reactivate', ['lesson' => $lesson->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_cancel()
    {
        // Data creation
        $lesson = $this->createOne(Lesson::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('lesson.cancel', ['lesson' => $lesson->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('lesson', [
            'id' => $lesson->id, 
            'active' => false
        ]);
    }
}