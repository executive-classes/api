<?php

namespace Tests\Feature\Classroom;

use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Classroom\Course\Course;
use Tests\FactoryMaker;

class CourseTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('course.index'));
        $this->assertAuthenticationRequired(route('course.store'), 'POST');
        $this->assertAuthenticationRequired(route('course.show', ['course' => 1]));
        $this->assertAuthenticationRequired(route('course.update', ['course' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('course.reactivate', ['course' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('course.cancel', ['course' => 1]), 'PATCH');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('course.index'));
        
        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $course = $this->makeOne(Course::class, true);
        $data = collect($course->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('course.store'), $course->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('course', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $course = $this->createOne(Course::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('course.show', ['course' => $course->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $course = $this->createOne(Course::class);
        $newCourse = $this->makeOne(Course::class, true);
        $data = collect($newCourse->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('course.update', ['course' => $course->id]),
                $newCourse->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('course', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_reactivate()
    {
        // Data creation
        $course = $this->createOne(Course::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('course.reactivate', ['course' => $course->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_cancel()
    {
        // Data creation
        $course = $this->createOne(Course::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('course.cancel', ['course' => $course->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('course', [
            'id' => $course->id, 
            'active' => false
        ]);
    }
}