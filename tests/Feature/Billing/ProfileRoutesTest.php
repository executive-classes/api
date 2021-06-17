<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\TaxTypeEnum;
use App\Http\Resources\Billling\ProfileResource;
use App\Models\Billing\User;
use App\Models\System\SystemLanguage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class ProfileRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * User instance.
     * 
     * @var User
     */
    private $user;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->user->login();
    }

    public function test_user_can_get_info()
    {
        $response = $this->getJson(route('profile.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $this->user->id);
    }

    public function test_user_can_update_name()
    {
        $data = ['name' => $this->faker()->name()];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $this->user->id);
        $response->assertJsonPath('data.name', $data['name']);
    }

    public function test_user_can_update_email()
    {
        $data = ['email' => $this->faker()->email()];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.id', $this->user->id);
        $response->assertJsonPath('data.email', $data['email']);
    }

    public function test_user_can_update_password()
    {
        $data = [
            'password' => 'NewPassword123@'
        ];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);

        $loginResponse = $this->postJson(route('login'), [
            'email' => $this->user->email,
            'password' => $data['password']
        ]);

        $loginResponse->assertOk();
    }

    public function test_user_can_update_tax()
    {
        $data = [
            'tax_type_id' => TaxTypeEnum::CPF,
            'tax_code' => $this->faker()->cpf,
            'tax_type_alt_id' => TaxTypeEnum::CNPJ,
            'tax_code_alt' => $this->faker()->cnpj,
        ];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.tax_type.id', $data['tax_type_id']);
        $response->assertJsonPath('data.tax_code', $data['tax_code']);
        $response->assertJsonPath('data.tax_type_alt.id', $data['tax_type_alt_id']);
        $response->assertJsonPath('data.tax_code_alt', $data['tax_code_alt']);
        $this->assertDatabaseHas('user', [
            'id' => $this->user->id,
            'tax_code' => $data['tax_code'] ? removeNonDigit($data['tax_code']) : $data['tax_code'],
            'tax_code_alt' => $data['tax_code_alt'] ? removeNonDigit($data['tax_code_alt']) : $data['tax_code_alt']
        ]);
    }

    public function test_user_can_update_phone()
    {
        $data = [
            'phone' => $this->faker()->phoneNumber,
            'phone_alt' => $this->faker()->phoneNumber,
        ];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.phone', $data['phone']);
        $response->assertJsonPath('data.phone_alt', $data['phone_alt']);
        $this->assertDatabaseHas('user', [
            'id' => $this->user->id, 
            'phone' => $data['phone'] ? removeNonDigit($data['phone']) : $data['phone'], 
            'phone_alt' => $data['phone'] ? removeNonDigit($data['phone_alt']) : $data['phone']
        ]);
    }

    public function test_user_can_update_language()
    {
        $data = [
            'system_language_id' => SystemLanguage::inRandomOrder()->first()->id,
        ];

        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonPath('data.language.id', $data['system_language_id']);
    }

    
}
