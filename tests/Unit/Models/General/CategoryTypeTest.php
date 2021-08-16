<?php

namespace Tests\Unit\Models\General;

use App\Models\General\CategoryType;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Models\HasFactoryAsserts;

class CategoryTypeTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var CategoryType
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = CategoryType::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'category_type',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }
}