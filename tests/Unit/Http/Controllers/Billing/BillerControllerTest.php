<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Http\Controllers\Billing\BillerController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Resources\Billing\Biller\BillerResource;
use App\Models\Eloquent\Billing\Biller\BillerFilters;
use App\Http\Resources\Billing\Biller\BillerCollection;
use App\Http\Requests\Billing\Biller\CreateBillerRequest;
use App\Http\Requests\Billing\Biller\UpdateBillerRequest;

class BillerControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var BillerController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = BillerController::class;

    public function test_index()
    {
        // Mocks Expects
        $this->db->shouldReceive('select')->andReturn($this->makeMany(Biller::class)->toArray());

        // Method execution
        $collection = $this->controller->index(new BillerFilters);

        // Assertions
        $this->assertCollectionResponse($collection, BillerCollection::class, 2);
    }

    public function test_store()
    {
        // Data creation
        $requestMock = $this->mockRequest(CreateBillerRequest::class);
        $biller = $this->makeOne(Biller::class);

        // Mocks Expects
        $this->db->shouldReceive('insert')->andReturn(true);
        $this->db->getPdo()->shouldReceive('lastInsertId')->andReturn(333);
        $requestMock->shouldReceive('validated')->andReturn($biller->toArray());

        // Method execution
        $resource = $this->controller->store($requestMock);

        // Assertions
        $this->assertResourceResponse($resource, BillerResource::class, Biller::class);
    }

    public function test_show()
    {
        // Data creation
        $biller = $this->makeOne(Biller::class);

        // Method execution
        $resource = $this->controller->show($biller);

        // Assertions
        $this->assertResourceResponse($resource, BillerResource::class, Biller::class);
    }

    public function test_update()
    {
        // Data creation
        $requestMock = $this->mockRequest(UpdateBillerRequest::class);
        $biller = $this->makeOne(Biller::class);
        $newBiller = $this->makeOne(Biller::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);
        $requestMock->shouldReceive('validated')->andReturn($newBiller->toArray());

        // Method execution
        $resource = $this->controller->update($requestMock, $biller);

        // Assertions
        $this->assertResourceResponse($resource, BillerResource::class, Biller::class);
    }

    public function test_cancel()
    {
        // Data creation
        $biller = $this->makeOne(Biller::class);

        // Mocks Expects
        $this->db->shouldReceive('update')->andReturn(true);

        // Method execution
        $resource = $this->controller->cancel($biller);

        // Assertions
        $this->assertResourceResponse($resource, BillerResource::class, Biller::class);
    }
}