<?php

namespace Tests\Unit\Models\System;

use App\Models\Eloquent\System\SystemBugLog\SystemBugLog;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class SystemBuglogTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var SystemBugLog
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = SystemBugLog::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'system_buglog',
            'timestamps' => false,
            'fillable' => [
                'date',
                'user_id',
                'cross_user_id',
                'agent',
                'url',
                'method',
                'ajax',
                'app_id',
                'route',
                'data',
                'error'
            ],
            'casts' => [
                'id' => 'int',
                'ajax' => 'boolean',
                'data' => 'object',
                'error' => 'object'
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

    public function test_app_relation()
    {
        $relation = $this->model->app();

        $this->assertBelongsToRelation($relation, $this->model, 'app_id');
    }
}