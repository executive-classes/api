<?php

namespace Tests\Unit\Http\Controllers;

use Mockery;
use Tests\MocksDatabase;
use Tests\TestCase;

class ControllerTestCase extends TestCase
{
    use MocksDatabase;

    /**
     * @var \Mockery\Mock|\App\Models\Classroom\Course
     */
    protected $modelMock;

    /**
     * @var \App\Http\Controllers\Controller
     */
    protected $controller;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->afterApplicationCreated(function () {
            $this->mockDb();
            $this->controller = new $this->controllerClass;
        });

        parent::setUp();
    }

    /**
     * Create a model mock.
     *
     * @param string $modelClass
     * @return \Mockery\Mock|mixed
     */
    protected function mockModel(string $modelClass)
    {
        return Mockery::mock($modelClass . '[save, update, delete, refresh]');
    }

    /**
     * Create a request mock.
     *
     * @param string $requestClass
     * @return \Mockery\Mock|mixed
     */
    protected function mockRequest(string $requestClass)
    {
        return Mockery::mock($requestClass . '[validated]');
    }
}