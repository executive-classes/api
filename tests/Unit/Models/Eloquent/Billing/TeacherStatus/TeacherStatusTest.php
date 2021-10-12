<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\TeacherStatus\TeacherStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class TeacherStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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