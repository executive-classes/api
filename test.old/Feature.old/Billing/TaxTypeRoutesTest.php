<?php

namespace Tests\Feature\Billing;

use App\Models\Billing\TaxType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class TaxTypeRoutesTest extends TestCase
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

    public function test_can_list_taxes()
    {
        $response = $this->getJson(route('taxes'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data',
            'primary',
            'secondary'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(TaxType::count(), 'data');
    }

    public function test_can_validate_taxes()
    {
        $data = [
            'tax_type_id' => 'cpf',
            'tax_code' => $this->faker()->cpf
        ];
        $response = $this->postJson(route('taxes.validate'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data', true);
    }
    
    public function test_can_validate_invalid_taxes()
    {
        $data = [
            'tax_type_id' => 'cpf',
            'tax_code' => '00000000000'
        ];
        $response = $this->postJson(route('taxes.validate'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data', false);
    }
}
