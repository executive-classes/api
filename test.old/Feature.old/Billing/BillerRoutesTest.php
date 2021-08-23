<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\BillerStatusEnum;
use App\Models\Eloquent\Billing\Biller\Biller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class BillerRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->getDevUser()->login();
        Biller::factory()->count(3)->create();
    }

    public function test_can_list_billers()
    {
        $response = $this->getJson(route('biller.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Biller::count(), 'data');
    }

    public function test_can_filter_biller_list()
    {
        $taxCode = Biller::first()->tax_code;
        $response = $this->getJson(route('biller.index', ['taxCode' => $taxCode]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(Biller::where('tax_code', $taxCode)->count(), 'data');
    }

    public function test_can_get_biller()
    {
        $id = Biller::first()->id;
        $response = $this->getJson(route('biller.show', ['biller' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
    }

    public function test_can_create_biller()
    {
        $data = Biller::factory()->make()->toArray();
        $response = $this->postJson(route('biller.store'), $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.name', $data['name']);
    }

    public function test_can_update_biller()
    {
        $data = Biller::factory()->make()->toArray();
        $id = Biller::first()->id;
        $response = $this->putJson(route('biller.update', ['biller' => $id]), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.name', $data['name']);
    }

    public function test_can_not_cancel_biller_by_update()
    {
        $data = ['biller_status_id' => BillerStatusEnum::CANCELED];
        $id = Biller::first()->id;
        $response = $this->putJson(route('biller.update', ['biller' => $id]), $data);

        $response->assertStatus(422);
    }

    public function test_can_cancel_biller()
    {
        $id = Biller::first()->id;
        $response = $this->deleteJson(route('biller.cancel', ['biller' => $id]));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $id);
        $response->assertJsonPath('data.status.id', BillerStatusEnum::CANCELED);
    }

    
}
