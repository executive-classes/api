<?php

namespace Tests\Feature\Classroom;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUser;
use Tests\Feature\FeatureTestCase;
use Tests\Providers\Classroom\CourseProvider;

class CourseTest extends FeatureTestCase
{
    use RefreshDatabase, CreatesUser, CourseProvider;

    /**
     * @var \App\Models\Billing\User\User
     */
    protected $user;

    /**
     * @var array
     */
    protected $routes;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getDevUser();
    }

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('course.index'));
        $this->assertAuthenticationRequired(route('course.store'), 'POST');
        $this->assertAuthenticationRequired(route('course.show', ['course' => 1]));
        $this->assertAuthenticationRequired(route('course.update', ['course' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('course.reactivate', ['course' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('course.cancel', ['course' => 1]), 'PATCH');
    }

    public function test_index_json()
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('course.index'));

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_create_json()
    {
        $course = $this->course(true);

        $response = $this->actingAs($this->user)
            ->postJson(route('course.store'), $course->toArray());

        $response->assertStatus(201);
        $this->assertResponseJson($response);
    }

    public function test_show_json()
    {
        $course = $this->course(true);

        $response = $this->actingAs($this->user)
            ->getJson(route('course.show', ['course' => $course->id]));

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_update_json()
    {
        $course = $this->course(true);
        $newCourse = $this->course(true);

        $response = $this->actingAs($this->user)
            ->putJson(
                route('course.update', ['course' => $course->id]),
                $newCourse->toArray()
            );

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_reactivate_json()
    {
        $course = $this->course(true);

        $response = $this->actingAs($this->user)
            ->patchJson(route('course.reactivate', ['course' => $course->id]));

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_cancel_json()
    {
        $course = $this->course(true);

        $response = $this->actingAs($this->user)
            ->patchJson(route('course.cancel', ['course' => $course->id]));

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }
}