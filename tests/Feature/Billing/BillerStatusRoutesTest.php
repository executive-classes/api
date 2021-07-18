<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\BillerStatusEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class BillerStatusRoutesTest extends TestCase
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
    }

    public function test_can_list_biller_status()
    {
        $response = $this->getJson(route('biller.status.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(count(BillerStatusEnum::getUpdatableValues()), 'data');
    }
}
