<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class EmployeePositionTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('employee.position.index'));
    }

    public function test_employee_position_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('employee.position.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}