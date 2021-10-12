<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Mockery;
use Tests\FactoryMaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use App\Http\Controllers\Billing\TaxTypeController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Resources\Billing\Tax\TaxTypeCollection;
use App\Http\Requests\Billing\TaxType\ValidateTaxTypeRequest;

class TaxTypeControllerTest extends ControllerTestCase
{
    use FactoryMaker;
    use WithFaker;

    /**
     * @var TaxTypeController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = TaxTypeController::class;

    /**
     * Set the controller constructor parameters.
     *
     * @return void
     */
    protected function setParameters()
    {
        $this->controllerParameters = [
            'taxType' => Mockery::mock(TaxType::class . '[find,validate]')
        ];
    }

    public function test_index()
    {
        // Data creation
        

        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(TaxType::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, TaxTypeCollection::class, 2);
    }

    public function test_validation()
    {
        // Data creation
        $requestMock = $this->mockRequest(ValidateTaxTypeRequest::class);

        // Mocks Expects
        $this->controllerParameters['taxType']->shouldReceive('find')->andReturn($this->controllerParameters['taxType']);
        $this->controllerParameters['taxType']->shouldReceive('validate')->andReturn($this->faker()->boolean());
        $requestMock->shouldReceive('get')->with('tax_code')->andReturn(config('test.tax.cnpj.valid')[0]);
        $requestMock->shouldReceive('get')->with('uf', null)->andReturn(null);

        // Method execution
        $response = $this->controller->validation($requestMock);

        // Assertions
        $this->assertJsonResponse($response, 200);
        $this->assertIsBool($response->getData()->data);
    }
}