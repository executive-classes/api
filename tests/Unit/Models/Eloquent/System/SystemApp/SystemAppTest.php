<?php

namespace Tests\Unit\Models\System;

use App\Models\Eloquent\System\SystemApp\SystemApp;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class SystemAppTest extends ModelTestCase
{
    use HasFactoryAsserts;

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