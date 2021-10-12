<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Illuminate\Http\JsonResponse;
use App\Support\Api\GuzzleResponse;
use App\Models\Api\ViaCep\ViaCepClient;
use Tests\Providers\Api\ViaCepProvider;
use App\Models\Eloquent\Billing\Address\Address;
use App\Http\Controllers\Billing\AddressController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Requests\Billing\Address\AddressRequest;
use App\Http\Resources\Billing\Address\AddressResource;
use App\Models\Eloquent\Billing\Address\AddressFilters;
use App\Services\Billing\Address\Contract\AddressMaker;
use App\Http\Resources\Billing\Address\AddressCollection;
use App\Http\Resources\Billing\Address\AddressSearchResource;

class AddressControllerTest extends ControllerTestCase
{
    use FactoryMaker;
    use ViaCepProvider;
    
    /**
     * @var AddressController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = AddressController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Address::class));
        
        // Method execution
        $collection = $this->controller->index(new AddressFilters());
        
        // Assertions
        $this->assertCollectionResponse($collection, AddressCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $address = $this->makeOne(Address::class);
        $makerMock = $this->makeMock(AddressMaker::class, '[create]');
        $requestMock = $this->mockRequest(AddressRequest::class);

        // Mocks Expects
        $makerMock->shouldReceive('create')->once()->andReturn($address);
        $requestMock->shouldReceive('validated')->once()->andReturn($address->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock, $makerMock);

        // Assertions
        $this->assertResourceResponse($resource, AddressResource::class, Address::class);
    }

    public function test_search()
    {
        // Data creation
        $cep = config('test.viacep.cep');
        $clientMock = $this->makeMock(ViaCepClient::class, '[consult]');
        $responseMock = $this->makeMock(GuzzleResponse::class, '[content]', [200]);

        // Mocks Expects
        $clientMock->shouldReceive('consult')->andReturn($responseMock);
        $responseMock->shouldReceive('content')->andReturn($this->makeOneConsultData());

        // Method execution
        $resource = $this->controller->search($cep, $clientMock);

        // Assertions
        $this->assertResourceResponse($resource, AddressSearchResource::class);
    }

    public function test_search_not_found()
    {
        // Data creation
        $cep = config('test.viacep.cep');
        $clientMock = $this->makeMock(ViaCepClient::class, '[consult]');
        $responseMock = $this->makeMock(GuzzleResponse::class, '[content]', [404]);

        // Mocks Expects
        $clientMock->shouldReceive('consult')->andReturn($responseMock);
        $responseMock->shouldReceive('content')->andReturn((object) ['erro' => true]);

        // Method execution
        $response = $this->controller->search($cep, $clientMock);

        // Assertions
        $this->assertJsonResponse($response, 404);
        $this->assertEquals(__('billing.address.fail.search', ['zip' => $cep]), $response->getData()->message);
    }

    public function test_search_error()
    {
        // Data creation
        $cep = config('test.viacep.cep');
        $clientMock = $this->createMock(ViaCepClient::class);

        // Mocks Expects
        $clientMock
            ->expects($this->once())
            ->method('consult')
            ->willThrowException(new \Exception('Some Exception'));

        // Method execution
        $response = $this->controller->search($cep, $clientMock);

        // Assertions
        $this->assertJsonResponse($response, 404);
        $this->assertEquals(__('billing.address.fail.search', ['zip' => $cep]), $response->getData()->message);
    }

    public function test_show()
    {
        // Data creation
        $address = $this->makeOne(Address::class);

        // Method execution
        $resource = $this->controller->show($address);
        
        // Assertions
        $this->assertResourceResponse($resource, AddressResource::class, Address::class);
    }

    public function test_update()
    {
        // Data creation
        $address = $this->makeOne(Address::class);
        $newAddress = $this->makeOne(Address::class);
        $requestMock = $this->mockRequest(AddressRequest::class);
        $makerMock = $this->makeMock(AddressMaker::class, '[update]');

        // Mocks Expects
        $requestMock->shouldReceive('validated')->once()->andReturn($newAddress->toArray());
        $makerMock->shouldReceive('update')->once()->andReturn($address);

        // Method execution
        $resource = $this->controller->update($requestMock, $address, $makerMock);

        // Assertions
        $this->assertResourceResponse($resource, AddressResource::class, Address::class);
    }

    public function test_destroy()
    {
        // Data creation
        $addressMock = $this->mockModel(Address::class);
        
        // Mocks Expects
        $addressMock->shouldReceive('delete')->andReturn(true);

        // Method execution
        $response = $this->controller->destroy($addressMock);

        // Assertions
        $this->assertJsonResponse($response, 204);
    }
}