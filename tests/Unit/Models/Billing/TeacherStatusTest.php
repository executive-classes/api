<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\TeacherStatus;
use Tests\Unit\Models\ModelTestCase;

class TeacherStatusTest extends ModelTestCase
{
    /**
     * @var TeacherStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = TeacherStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'teacher_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}