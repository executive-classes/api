<?php

namespace Tests\Unit\Model\Classroom;

use App\Models\Eloquent\Classroom\MaterialStatus\MaterialStatus;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class MaterialStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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