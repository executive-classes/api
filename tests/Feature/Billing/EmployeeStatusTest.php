<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class EmployeeStatusTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('employee.status.index'));
    }

    public function test_employee_status_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('employee.status.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}