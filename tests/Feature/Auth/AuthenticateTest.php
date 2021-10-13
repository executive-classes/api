<?php

namespace Tests\Feature\Auth;

use Tests\FactoryMaker;
use Tests\Feature\FeatureTestCase;
use App\Models\Eloquent\Billing\User\User;

class AuthenticateTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('login.cross'), 'POST');
        $this->assertAuthenticationRequired(route('token.show'));
        $this->assertAuthenticationRequired(route('logout'));
    }

    public function test_login()
    {
        // Data creation
        $data = [
            'email' => config('test.user.type.dev.email'),
            'password' => config('test.user.password')
        ];

        // Route execution
        $response = $this->postJson(route('login'), $data);

        // // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertEquals($data['email'], request()->user()->email);
    }

    public function test_login_cross()
    {
        // Data creation
        $user = $this->createOne(User::class);
        $data = ['user_id' => $user->id];

        // // Route execution
        $response = $this->actingAs($this->user)
            ->postJson(route('login.cross'), $data);

        // // Assertions
        $this->assertResponseJson($response, 200);
        $this->assertEquals($data['user_id'], request()->user()->id);
    }

    public function test_token_show()
    {
        // Login
        $response = $this->makeLogin();
        $token = $response->getData()->data->plainTextToken;

        // Route execution
        $response = $this->getJson(route('token.show'), ['Authorization' => "Bearer $token"]);

        // Assertions
        $this->assertResponseJson($response, 200);
    }

    public function test_logout()
    {
        // Login
        $this->makeLogin();

        // Route execution
        $response = $this->getJson(route('logout'));

        // // Assertions
        $this->assertResponseJson($response, 204);
    }

    private function makeLogin()
    {
        $data = [
            'email' => config('test.user.type.dev.email'),
            'password' => config('test.user.password')
        ];

        return $this->postJson(route('login'), $data);
    }
}