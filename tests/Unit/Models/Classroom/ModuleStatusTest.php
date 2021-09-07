<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\ModuleStatus\ModuleStatus;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class ModuleStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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