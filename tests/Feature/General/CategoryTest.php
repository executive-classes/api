<?php

namespace Tests\Feature\General;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesUser;
use Tests\Feature\FeatureTestCase;
use Tests\Providers\General\CategoryProvider;

class CategoryTest extends FeatureTestCase
{
    use RefreshDatabase, CreatesUser, CategoryProvider;

    /**
     * @var \App\Models\Eloquent\Billing\User\User
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
        $this->assertAuthenticationRequired(route('category.index'));
        $this->assertAuthenticationRequired(route('category.store'), 'POST');
        $this->assertAuthenticationRequired(route('category.show', ['category' => 1]));
        $this->assertAuthenticationRequired(route('category.update', ['category' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('category.delete', ['category' => 1]), 'DELETE');
    }

    public function test_index_json()
    {
        $response = $this->actingAs($this->user)
            ->getJson(route('category.index'));

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_create_json()
    {
        $category = $this->category(true);

        $response = $this->actingAs($this->user)
            ->postJson(route('category.store'), $category->toArray());

        $response->assertStatus(201);
        $this->assertResponseJson($response);
    }

    public function test_show_json()
    {
        $category = $this->category(true);

        $response = $this->actingAs($this->user)
            ->getJson(route('category.show', ['category' => $category->id]));

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_update_json()
    {
        $category = $this->category(true);
        $newCategory = $this->category(true);

        $response = $this->actingAs($this->user)
            ->putJson(
                route('category.update', ['category' => $category->id]), 
                $newCategory->toArray()
            );

        $response->assertStatus(200);
        $this->assertResponseJson($response);
    }

    public function test_delete_response()
    {
        $category = $this->category(true);

        $response = $this->actingAs($this->user)
            ->deleteJson(route('category.delete', ['category' => $category->id]));

        $response->assertStatus(204);
        $this->assertDatabaseMissing('category', ['id' => $category->id]);
    }
}