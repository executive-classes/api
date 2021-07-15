<?php

namespace Tests\Feature\Billing;

use App\Enums\Billing\TeacherStatusEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UseUsers;

class TeacherStatusRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->getDevUser()->login();
    }

    public function test_can_list_teacher_status()
    {
        $response = $this->getJson(route('teacher.status.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'status',
            'data'
        ]);
        $response->assertJsonPath('status', true);
        $response->assertJsonCount(count(TeacherStatusEnum::getUpdatableValues()), 'data');
    }
}
