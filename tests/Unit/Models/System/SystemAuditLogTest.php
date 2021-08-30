<?php

namespace Tests\Unit\Models\System;

use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;
use App\Models\Eloquent\System\SystemAuditLog\SystemAuditLog;

class SystemAuditLogTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var SystemAuditLog
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = SystemAuditLog::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'system_auditlog',
            'timestamps' => false,
            'fillable' => [
                'date',
                'user_id',
                'cross_user_id',
                'relations',
                'agent',
                'method',
                'url',
                'route',
                'ajax',
                'type',
                'table',
                'before',
                'after'
            ],
            'casts' => [
                'id' => 'int',
                'ajax' => 'boolean',
                'before' => 'object',
                'after' => 'object'
            ]
        ]);
    }

    public function test_user_relation()
    {
        $relation = $this->model->user();

        $this->assertBelongsToRelation($relation, $this->model, 'user_id');
    }

    public function test_cross_user_relation()
    {
        $relation = $this->model->cross_user();

        $this->assertBelongsToRelation($relation, $this->model, 'cross_user_id');
    }
}
