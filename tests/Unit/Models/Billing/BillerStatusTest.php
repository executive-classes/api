<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\BillerStatus;
use Tests\Unit\Models\ModelTestCase;

class BillerStatusTest extends ModelTestCase
{
    /**
     * @var BillerStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = BillerStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'biller_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}