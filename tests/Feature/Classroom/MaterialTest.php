<?php

namespace Tests\Feature\Classroom;

use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Classroom\Material\Material;
use Tests\FactoryMaker;

class MaterialTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('material.index'));
        $this->assertAuthenticationRequired(route('material.store'), 'POST');
        $this->assertAuthenticationRequired(route('material.show', ['material' => 1]));
        $this->assertAuthenticationRequired(route('material.update', ['material' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('material.reactivate', ['material' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('material.cancel', ['material' => 1]), 'PATCH');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('material.index'));
        
        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $material = $this->makeOne(Material::class, true);
        $data = collect($material->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('material.store'), $material->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('material', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $material = $this->createOne(Material::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('material.show', ['material' => $material->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $material = $this->createOne(Material::class);
        $newMaterial = $this->makeOne(Material::class, true);
        $data = collect($newMaterial->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('material.update', ['material' => $material->id]),
                $newMaterial->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('material', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_reactivate()
    {
        // Data creation
        $material = $this->createOne(Material::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('material.reactivate', ['material' => $material->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_cancel()
    {
        // Data creation
        $material = $this->createOne(Material::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('material.cancel', ['material' => $material->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('material', [
            'id' => $material->id, 
            'active' => false
        ]);
    }
}