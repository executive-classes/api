<?php

namespace Tests\Unit\Models\System;

use App\Models\System\SystemApp\SystemApp;
use Tests\Unit\Models\ModelTestCase;

class SystemAppTest extends ModelTestCase
{
    /**
     * @var SystemApp
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = SystemApp::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'system_app',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => [
                'active' => 'boolean'
            ]
        ]);
    }
}