<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Classroom\ModuleStatus\ModuleStatus;
use Tests\Unit\Models\ModelTestCase;

class ModuleStatusTest extends ModelTestCase
{
    /**
     * @var ModuleStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = ModuleStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'module_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}