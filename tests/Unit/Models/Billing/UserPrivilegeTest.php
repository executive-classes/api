<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\UserPrivilege\UserPrivilege;
use Tests\Unit\Models\ModelTestCase;

class UserPrivilegeTest extends ModelTestCase
{
    /**
     * @var UserPrivilege
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = UserPrivilege::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'user_privilege',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => [
                'teacher_can' => 'boolean',
                'student_can' => 'boolean'
            ]
        ]);
    }
}