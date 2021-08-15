<?php

namespace Tests\Feature;

use Illuminate\Testing\TestResponse;
use InvalidArgumentException;
use Tests\TestCase;

class FeatureTestCase extends TestCase
{
    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Assert that the given route only can be accessed by authenticated user.
     *
     * @param string $uri
     * @param string $method
     * @return void
     */
    protected function assertAuthenticationRequired(string $uri, string $method = 'get')
    {
        $method = strtolower($method);
        if (!in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
            throw new InvalidArgumentException('Invalid method: ' . $method);
        }

        $method .= 'Json';

        $response = $this->$method($uri);
        $response->assertStatus(401);
    }

    /**
     * Assert that the response will be the default.
     *
     * @param TestResponse $response
     * @return void
     */
    protected function assertResponseJson(TestResponse $response)
    {
        $response->assertJsonPath('status', true);
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
    }
}