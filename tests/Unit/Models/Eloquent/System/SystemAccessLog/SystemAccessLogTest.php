<?php

namespace Tests\Unit\Models\System;

use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;
use App\Models\Eloquent\System\SystemAccessLog\SystemAccessLog;

class SystemAccessLogTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var SystemAccessLog
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = SystemAccessLog::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'system_accesslog',
            'timestamps' => false,
            'fillable' => [
                'date',
                'user_id',
                'cross_user_id',
                'agent',
                'method',
                'url',
                'route',
                'ajax',
                'allowed',
                'code'
            ],
            'casts' => [
                'id' => 'int',
                'ajax' => 'boolean',
                'allowed' => 'boolean'
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