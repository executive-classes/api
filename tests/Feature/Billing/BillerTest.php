<?php

namespace Tests\Feature\Billing;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Enums\Billing\BillerStatusEnum;
use App\Models\Eloquent\Billing\Biller\Biller;

class BillerTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('biller.index'));
        $this->assertAuthenticationRequired(route('biller.store'), 'POST');
        $this->assertAuthenticationRequired(route('biller.show', ['biller' => 1]));
        $this->assertAuthenticationRequired(route('biller.update', ['biller' => 1]), 'PUT');
        $this->assertAuthenticationRequired(route('biller.cancel', ['biller' => 1]), 'DELETE');
    }

    public function test_biller_index()
    {
        // Data creation
        $this->createMany(Biller::class);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('biller.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_biller_store()
    {
        // Data creation
        $biller = $this->makeOne(Biller::class, true);
        $data = collect($biller->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('biller.store'), $biller->toArray());

        // Assertions
        $this->assertResponseJson($response, 201);
        $this->assertDatabaseHas('biller', $data->only(['name'])->toArray());
    }

    public function test_biller_show()
    {
        // Data creation
        $biller = $this->createOne(Biller::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('biller.show', ['biller' => $biller->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_biller_update()
    {
        // Data creation
        $biller = $this->createOne(Biller::class, true);
        $newBiller = $this->makeOne(Biller::class, true);
        $data = collect($newBiller->toArray());

        // Route execution
        $response = $this->actingAs($this->user)
            ->putJson(route('biller.update', ['biller' => $biller->id]), $newBiller->toArray());

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('biller', $data->only(['name'])->toArray());
    }

    public function test_biller_cancel()
    {
        // Data creation
        $biller = $this->createOne(Biller::class, true);

        // Route execution
        $response = $this->actingAs($this->user)
            ->deleteJson(route('biller.cancel', ['biller' => $biller->id]));

        // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertDatabaseHas('biller', [
            'id' => $biller->id,
            'biller_status_id' => BillerStatusEnum::CANCELED
        ]);
    }
}