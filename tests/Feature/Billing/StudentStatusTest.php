<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class StudentStatusTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('student.status.index'));
    }

    public function test_student_status_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('student.status.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}