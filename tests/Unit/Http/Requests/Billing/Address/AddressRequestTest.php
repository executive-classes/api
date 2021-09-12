<?php

namespace Tests\Unit\Http\Requests\Billing\Address;

use App\Enums\Billing\CountryEnum;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Unit\Http\Requests\RequestTestCase;
use App\Http\Requests\Billing\Address\AddressRequest;

class AddressRequestTest extends RequestTestCase
{
    use WithFaker;

    /**
     * @var string
     */
    protected $requestClass = AddressRequest::class;

    public function test_zip_field()
    {
        $field = 'zip';

        $this->assertPasses($field, [$field => 'some-zip']);
        $this->assertPasses($field, [$field => '00000-000', 'country' => CountryEnum::BR]);

        $this->assertNotPasses($field, [$field => 'invalid zip', 'country' => CountryEnum::BR]);
        $this->assertNotPasses($field, [$field => null]);
        $this->assertNotPasses($field, []);
    }

    public function test_number_field()
    {
        $field = 'number';

        $this->assertPasses($field, [$field => '8']);
        $this->assertPasses($field, [$field => 8]);
        $this->assertPasses($field, [$field => 12]);
        
        $this->assertNotPasses($field, [$field => '12345678901']);
        $this->assertNotPasses($field, [$field => null]);
        $this->assertNotPasses($field, []);
    }

    public function test_complement_field()
    {
        $field = 'complement';

        $this->assertPasses($field, [$field => 'valid complement']);
        $this->assertPasses($field, [$field => null]);
        $this->assertPasses($field, []);
        
        $this->assertNotPasses($field, [$field => false]);
        $this->assertNotPasses($field, [$field => 123]);
    }

    public function test_country_field()
    {
        $field = 'country';

        foreach (CountryEnum::getValues() as $value) {
            $this->assertPasses($field, [$field => $value]);
        }
        $this->assertPasses($field, []);

        $this->assertNotPasses($field, [$field => 'invalid country']);
        $this->assertNotPasses($field, [$field => null]);
    }

    public function test_street_field()
    {
        $field = 'street';

        $this->assertPasses($field, [$field => 'valid street']);
        $this->assertPasses($field, [$field => 'valid street', 'country' => CountryEnum::BR]);
        $this->assertPasses($field, ['country' => CountryEnum::US]);

        $this->assertNotPasses($field, ['country' => CountryEnum::BR]);
        $this->assertNotPasses($field, [$field => null, 'country' => CountryEnum::BR]);
    }

    public function test_district_field()
    {
        $field = 'district';
        
        $this->assertPasses($field, [$field => 'valid district']);
        $this->assertPasses($field, [$field => 'valid district', 'country' => CountryEnum::BR]);
        $this->assertPasses($field, ['country' => CountryEnum::US]);

        $this->assertNotPasses($field, ['country' => CountryEnum::BR]);
        $this->assertNotPasses($field, [$field => null, 'country' => CountryEnum::BR]);
    }

    public function test_city_field()
    {
        $field = 'city';
        
        $this->assertPasses($field, [$field => 'valid city']);
        $this->assertPasses($field, [$field => 'valid city', 'country' => CountryEnum::BR]);
        $this->assertPasses($field, ['country' => CountryEnum::US]);

        $this->assertNotPasses($field, ['country' => CountryEnum::BR]);
        $this->assertNotPasses($field, [$field => null, 'country' => CountryEnum::BR]);
    }

    public function test_state_field()
    {
        $field = 'state';

        $this->assertPasses($field, [$field => 'st']);
        $this->assertPasses($field, [$field => 'st', 'country' => CountryEnum::BR]);
        $this->assertPasses($field, ['country' => CountryEnum::US]);

        $this->assertNotPasses($field, ['country' => CountryEnum::BR]);
        $this->assertNotPasses($field, [$field => 'invalid state', 'country' => CountryEnum::BR]);
        $this->assertNotPasses($field, [$field => null, 'country' => CountryEnum::BR]);
    }
}