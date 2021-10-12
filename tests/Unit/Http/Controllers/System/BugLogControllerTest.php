<?php

namespace Tests\Unit\Http\Controllers\System;

use Tests\FactoryMaker;
use App\Http\Requests\System\GetBugLogRequest;
use App\Http\Controllers\System\BugLogController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Models\Eloquent\System\SystemBugLog\SystemBugLog;
use App\Models\Eloquent\System\SystemBugLog\SystemBugLogFilters;
use App\Http\Resources\System\SystemBugLog\SystemBugLogCollection;

class BugLogControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var BugLogController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = BugLogController::class;

    public function test_index()
    {
        // Data creation
        $requestMock = $this->mockRequest(GetBugLogRequest::class);

        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(SystemBugLog::class)->toArray());
        $requestMock->shouldReceive('get')->andReturn(1000);
        
        // Method execution
        $collection = $this->controller->index($requestMock, new SystemBugLogFilters);
        
        // Assertions
        $this->assertCollectionResponse($collection, SystemBugLogCollection::class, 2);
    }
}