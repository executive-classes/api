<?php

namespace Tests\Unit\Models\Billing;

use Tests\Unit\Models\ModelTestCase;
use App\Models\Eloquent\Billing\CollectionItem\CollectionItem;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CollectionItemTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var CollectionItem
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = CollectionItem::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'collection_item',
            'fillable' => [
                'amount'
            ]
        ]);
    }

    public function test_collection_relation()
    {
        $relation = $this->model->collection();

        $this->assertBelongsToRelation($relation, $this->model, 'collection_id');
    }

    public function test_student_relation()
    {
        $relation = $this->model->student();

        $this->assertBelongsToRelation($relation, $this->model, 'student_id');
    }
}