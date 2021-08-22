<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\CollectionStatus\CollectionStatus;
use Tests\Unit\Models\ModelTestCase;

class CollectionStatusTest extends ModelTestCase
{
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