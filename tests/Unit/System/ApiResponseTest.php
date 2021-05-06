<?php

namespace Tests\Unit\System;

use App\Http\Response\Api;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class ApiResponseTest extends TestCase
{
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_helper_returns_api_response_instance()
    {
        $this->assertInstanceOf(Api::class, api());
    }

    public function test_header_can_be_added()
    {
        $api = api();

        $api->header('test', 'test');
        $this->assertArrayHasKey('test', $api->headers);
        $this->assertContains('test', $api->headers);

        $test = [
            'test1' => 'test',
            'test2' => 'test'
        ];
        $api->headers($test);
        $this->assertArrayHasKey('test1', $api->headers);
        $this->assertArrayHasKey('test1', $api->headers);
    }

    public function test_code_can_be_defined()
    {
        $api = api();

        $api->code(200);
        $this->assertEquals(200, $api->code);
    }

    public function test_success_response_can_be_sent()
    {
        $successResponse = api()->success(200, 'test', ['test' => 'test'], 'test');
        $this->assertInstanceOf(JsonResponse::class, $successResponse);

        $successContent = $successResponse->getOriginalContent();
        $this->assertIsArray($successContent);

        $this->assertEquals(200, $successResponse->getStatusCode());

        $this->assertArrayHasKey('status', $successContent);
        $this->assertTrue($successContent['status']);

        $this->assertArrayHasKey('message', $successContent);
        $this->assertIsString($successContent['message']);
        $this->assertEquals('test', $successContent['message']);

        $this->assertArrayHasKey('data', $successContent);
        $this->assertEquals('test', $successContent['data']);

        $this->assertArrayHasKey('test', $successContent);
        $this->assertEquals('test', $successContent['test']);
    }

    public function test_error_response_can_be_sent()
    {
        $errorResponse = api()->error(500, 'test', 'test', ['test' => 'test']);
        $this->assertInstanceOf(JsonResponse::class, $errorResponse);

        $errorContent = $errorResponse->getOriginalContent();
        $this->assertIsArray($errorContent);

        $this->assertEquals(500, $errorResponse->getStatusCode());

        $this->assertArrayHasKey('status', $errorContent);
        $this->assertFalse($errorContent['status']);

        $this->assertArrayHasKey('message', $errorContent);
        $this->assertIsString($errorContent['message']);
        $this->assertEquals('test', $errorContent['message']);

        $this->assertArrayHasKey('data', $errorContent);
        $this->assertEquals('test', $errorContent['data']);

        $this->assertArrayHasKey('test', $errorContent);
        $this->assertEquals('test', $errorContent['test']);
    }

    
}
