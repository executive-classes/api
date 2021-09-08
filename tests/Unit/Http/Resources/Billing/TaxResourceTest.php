<?php

namespace Tests\Unit\Http\Resources\Billing;

use App\Http\Resources\Billling\Tax\TaxResource;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\FactoryMaker;
use Tests\Unit\Http\Resources\ResourceTestCase;

class TaxResourceTest extends ResourceTestCase
{
    use FactoryMaker;
    use WithFaker;

    public function test_resource()
    {
        $resource = new TaxResource($this->makeOneTax());

        $this->runResourceAssertions($resource);
    }

    public function test_resource_json()
    {
        $resource = new TaxResource($this->makeOneTax());

        $this->runResourceJsonAssertion($resource, [
            'id',
            'name',
            'code',
            'priority',
            'mask',
        ]);
    }

    private function makeOneTax()
    {
        $tax = TaxType::factory()->make();
        $tax->code = $this->faker('pt_BR')->cnpj;
        return $tax;
    }
}