<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class BillerStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

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