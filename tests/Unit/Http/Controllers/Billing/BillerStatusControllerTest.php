<?php

namespace Tests\Unit\Http\Controllers\Billing;

use Tests\FactoryMaker;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Http\Controllers\Billing\BillerStatusController;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use App\Http\Resources\Billing\BillerStatus\BillerStatusCollection;

class BillerStatusControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var BillerStatusController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = BillerStatusController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(BillerStatus::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, BillerStatusCollection::class, 2);
    }
}