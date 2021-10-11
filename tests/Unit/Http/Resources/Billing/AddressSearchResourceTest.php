<?php

namespace Tests\Unit\Http\Resources\Billing;

use Mockery;
use stdClass;
use Tests\FactoryMaker;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Unit\Http\Resources\ResourceTestCase;
use App\Http\Resources\Billing\Address\AddressSearchResource;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;

class TokenResourceTest extends ResourceTestCase
{
    use FactoryMaker;
    use WithFaker;

    public function test_resource()
    {
        $resource = new AddressSearchResource($this->makeOneAddress());
        $this->runResourceAssertions($resource);
    }

    public function test_resource_json()
    {
        $model = $this->makeOneAddress();
        $resource = new AddressSearchResource($model);
        $this->runResourceJsonAssertion($resource, [
            'id',
            'zip',
            'street',
            'number',
            'complement',
            'district',
            'city',
            'state',
            'country',
        ]);
    }

    private function makeOneAddress()
    {
        return (object) [
            'cep' => $this->faker('pt_BR')->postcode,
            'logradouro' => $this->faker('pt_BR')->streetAddress,
            'bairro' => $this->faker('pt_BR')->region,
            'localidade' => $this->faker('pt_BR')->city,
            'uf' => $this->faker('pt_BR')->stateAbbr,
        ];
    }
}