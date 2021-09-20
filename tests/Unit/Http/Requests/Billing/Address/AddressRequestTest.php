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
        $this->assertRequiredRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_number_field()
    {
        $field = 'number';

        $this->assertRequiredRule($field);
        $this->assertMaxStringRule($field, 10);
        $this->assertNotNullableRule($field);
    }

    public function test_complement_field()
    {
        $field = 'complement';

        $this->assertPasses($field, [$field => 'valid complement']);
        $this->assertSometimesRule($field);
        $this->assertNullableRule($field);
        $this->assertStringRule($field);
        $this->assertMaxStringRule($field, 255);
    }

    public function test_country_field()
    {
        $field = 'country';

        $this->assertSometimesRule($field);
        $this->assertEnumRule($field, CountryEnum::getValues());
        $this->assertStringRule($field);
        $this->assertNotNullableRule($field);
    }

    public function test_street_field()
    {
        $field = 'street';

        $this->assertPasses($field, [$field => 'valid street']);
        $this->assertRequiredIfRule($field, ['country' => CountryEnum::US], ['country' => CountryEnum::BR]);
        $this->assertStringRule($field);
    }

    public function test_district_field()
    {
        $field = 'district';
        
        $this->assertPasses($field, [$field => 'valid district']);
        $this->assertRequiredIfRule($field, ['country' => CountryEnum::US], ['country' => CountryEnum::BR]);
        $this->assertStringRule($field);
    }

    public function test_city_field()
    {
        $field = 'city';
        
        $this->assertPasses($field, [$field => 'valid city']);
        $this->assertRequiredIfRule($field, ['country' => CountryEnum::US], ['country' => CountryEnum::BR]);
        $this->assertStringRule($field);
    }

    public function test_state_field()
    {
        $field = 'state';

        $this->assertPasses($field, [$field => 'st']);
        $this->assertRequiredIfRule($field, ['country' => CountryEnum::US], ['country' => CountryEnum::BR]);
        $this->assertStringRule($field);
        $this->assertMaxStringRule($field, 2);
    }
}