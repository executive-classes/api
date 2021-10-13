<?php

namespace Tests\Feature\Billing;

use Tests\Feature\FeatureTestCase;
use Tests\FactoryMaker;

class TeacherStatusTest extends FeatureTestCase
{
    use FactoryMaker;

    public function test_authentication_protection()
    {
        $this->assertAuthenticationRequired(route('teacher.status.index'));
    }

    public function test_teacher_status_index()
    {
        // Route execution
        $response = $this->actingAs($this->user)
            ->getJson(route('teacher.status.index'));

        // Assertions
        $this->assertResponseJson($response, 200);
    }
}