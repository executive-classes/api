<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\CreatesUser;
use InvalidArgumentException;
use Illuminate\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureTestCase extends TestCase
{
    use RefreshDatabase;
    use CreatesUser;
    
    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * @var \App\Models\Eloquent\Billing\User\User
     */
    protected $user;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->getDevUser();
    }
    
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
     * @param integer $code
     * @param boolean $status
     * @return void
     */
    protected function assertResponseJson(TestResponse $response, int $code, bool $status = true)
    {
        $response->assertStatus($code);

        if ($code != 204) {
            $response->assertJsonPath('status', $status);
            $response->assertJsonStructure([
                'status',
                'data'
            ]);
        }
    }
}