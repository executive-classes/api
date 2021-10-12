<?php

namespace Tests\Unit\Models\General;

use App\Models\Eloquent\General\CategoryType\CategoryType;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

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