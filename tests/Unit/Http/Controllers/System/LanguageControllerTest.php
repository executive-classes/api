<?php

namespace Tests\Unit\Http\Controllers\System;

use Tests\FactoryMaker;
use App\Http\Controllers\System\LanguageController;
use Tests\Unit\Http\Controllers\ControllerTestCase;
use App\Models\Eloquent\System\SystemLanguage\SystemLanguage;
use App\Http\Resources\System\SystemLanguage\SystemLanguageCollection;

class LanguageControllerTest extends ControllerTestCase
{
    use FactoryMaker;

    /**
     * @var LanguageController
     */
    protected $controller;

    /**
     * @var string
     */
    protected $controllerClass = LanguageController::class;

    public function test_index()
    {
        // Mocks Expects   
        $this->db->shouldReceive('select')->andReturn($this->makeMany(SystemLanguage::class)->toArray());
        
        // Method execution
        $collection = $this->controller->index();
        
        // Assertions
        $this->assertCollectionResponse($collection, SystemLanguageCollection::class, 2);
    }
}