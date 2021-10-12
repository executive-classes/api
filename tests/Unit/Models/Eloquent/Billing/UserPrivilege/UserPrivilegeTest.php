<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\UserPrivilege\UserPrivilege;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class UserPrivilegeTest extends ModelTestCase
{
    use HasFactoryAsserts;

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