<?php

namespace Tests\Feature\Classroom;

use App\Models\Eloquent\Classroom\Module\Module;
use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;

class ModuleTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('module.index'));
        $this->assertAuthenticationRequired(route('module.store'), 'POST');
        $this->assertAuthenticationRequired(route('module.show', ['module' => 1]));
        $this->assertAuthenticationRequired(route('module.update', ['module' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('module.reactivate', ['module' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('module.cancel', ['module' => 1]), 'PATCH');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('module.index'));
        
        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $module = $this->makeOne(Module::class, true);
        $data = collect($module->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('module.store'), $module->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('module', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $module = $this->createOne(Module::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('module.show', ['module' => $module->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $module = $this->createOne(Module::class);
        $newModule = $this->makeOne(Module::class, true);
        $data = collect($newModule->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('module.update', ['module' => $module->id]),
                $newModule->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('module', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_reactivate()
    {
        // Data creation
        $module = $this->createOne(Module::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('module.reactivate', ['module' => $module->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_cancel()
    {
        // Data creation
        $module = $this->createOne(Module::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('module.cancel', ['module' => $module->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('module', [
            'id' => $module->id, 
            'active' => false
        ]);
    }
}