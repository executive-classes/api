<?php

namespace Tests\Feature\Classroom;

use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Classroom\Test\Test;
use Tests\FactoryMaker;

class TestTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('test.index'));
        $this->assertAuthenticationRequired(route('test.store'), 'POST');
        $this->assertAuthenticationRequired(route('test.show', ['test' => 1]));
        $this->assertAuthenticationRequired(route('test.update', ['test' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('test.reactivate', ['test' => 1]), 'PATCH');
        $this->assertAuthenticationRequired(route('test.cancel', ['test' => 1]), 'PATCH');
    }

    public function test_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('test.index'));
        
        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_create()
    {
        // Data creation
        $test = $this->makeOne(Test::class, true);
        $data = collect($test->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('test.store'), $test->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('test', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_show()
    {
        // Data creation
        $test = $this->createOne(Test::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('test.show', ['test' => $test->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_update()
    {
        // Data creation
        $test = $this->createOne(Test::class);
        $newTest = $this->makeOne(Test::class, true);
        $data = collect($newTest->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(
                route('test.update', ['test' => $test->id]),
                $newTest->toArray()
            );

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('test', $data->only(['name', 'category_id'])->toArray());
    }

    public function test_reactivate()
    {
        // Data creation
        $test = $this->createOne(Test::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('test.reactivate', ['test' => $test->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_cancel()
    {
        // Data creation
        $test = $this->createOne(Test::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->patchJson(route('test.cancel', ['test' => $test->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('test', [
            'id' => $test->id, 
            'active' => false
        ]);
    }
}