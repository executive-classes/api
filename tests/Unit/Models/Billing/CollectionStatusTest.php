<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\CollectionStatus\CollectionStatus;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CollectionStatusTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var CollectionStatus
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = CollectionStatus::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'collection_status',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}