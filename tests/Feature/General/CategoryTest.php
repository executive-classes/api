<?php

namespace Tests\Feature\General;

use App\Models\Eloquent\General\Category\Category;
use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;

class CategoryTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('category.index'));
        $this->assertAuthenticationRequired(route('category.store'), 'POST');
        $this->assertAuthenticationRequired(route('category.show', ['category' => 1]));
        $this->assertAuthenticationRequired(route('category.update', ['category' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('category.delete', ['category' => 1]), 'DELETE');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('category.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $category = $this->makeOne(Category::class, true);
        $data = collect($category->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('category.store'), $category->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('category', $data->only(['name', 'description'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $category = $this->createOne(Category::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('category.show', ['category' => $category->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $category = $this->createOne(Category::class);
        $newCategory = $this->makeOne(Category::class, true);
        $data = collect($newCategory->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('category.update', ['category' => $category->id]), 
                $newCategory->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('category', $data->only(['name', 'description'])->toArray());
    }

    public function test_delete()
    {
        // Data creation
        $category = $this->createOne(Category::class);
        $data = collect($category->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('category.delete', ['category' => $category->id]));

        // Assertions
        $this->assertResponseJson($response, 204);
        $this->assertDatabaseMissing('category', $data->only(['id'])->toArray());
    }
}