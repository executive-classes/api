<?php

namespace Tests\Unit\Http\Controllers;

use Mockery;
use Tests\TestCase;
use Tests\MocksDatabase;
use Illuminate\Http\JsonResponse;

class ControllerTestCase extends TestCase
{
    use MocksDatabase;

    /**
     * @var \Mockery\Mock|\App\Models\Eloquent\Classroom\Course
     */
    protected $modelMock;

    /**
     * @var \App\Http\Controllers\Controller
     */
    protected $controller;

    /**
     * @var array
     */
    protected $controllerParameters = [];

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->setParameters();

        $this->afterApplicationCreated(function () {
            $this->mockDb();
            $this->controller = new $this->controllerClass(...array_values($this->controllerParameters));
        });

        parent::setUp();
    }

    /**
     * Set the controller constructor parameters.
     *
     * @return void
     */
    protected function setParameters()
    {
        $this->controllerParameters = [];
    }

    /**
     * Create a model mock.
     *
     * @param string $modelClass
     * @param string $methods
     * @return \Mockery\Mock|mixed
     */
    protected function mockModel(string $modelClass, string $methods = '[save, update, delete, refresh]')
    {
        return $this->makeMock($modelClass . $methods);
    }

    /**
     * Create a request mock.
     *
     * @param string $requestClass
     * @param string $methods
     * @return \Mockery\Mock|mixed
     */
    protected function mockRequest(string $requestClass, string $methods = '[validated,get,user]')
    {
        return $this->makeMock($requestClass . $methods);
    }

    protected function assertJsonResponse($response, int $code)
    {
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals($code, $response->getStatusCode());
    }

    protected function assertCollectionResponse($response, string $collectionClass, int $count)
    {
        $this->assertInstanceOf($collectionClass, $response);
        $this->assertCount($count, $response);
    }

    protected function assertResourceResponse($response, string $resourceClass, string $modelClass = null)
    {
        $this->assertInstanceOf($resourceClass, $response);

        if ($modelClass) {
            $this->assertInstanceOf($modelClass, $response->resource);
        }
    }
}