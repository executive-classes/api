<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Classroom\MaterialStatus;
use Tests\Unit\Models\ModelTestCase;

class MaterialStatusTest extends ModelTestCase
{
    /**
     * @var MaterialStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = MaterialStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'material_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}