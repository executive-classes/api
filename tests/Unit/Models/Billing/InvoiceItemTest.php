<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\InvoiceItem;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Models\HasFactoryAsserts;

class InvoiceItemTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var InvoiceItem
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = InvoiceItem::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'invoice_item',
            'fillable' => [
                'description',
                'qty',
                'unity_price',
                'price'
            ]
        ]);
    }

    public function test_collection_relation()
    {
        $relation = $this->model->collection();

        $this->assertHasOneThroughRelation($relation, $this->model, 'invoice_id', 'collection_id');
    }

    public function test_invoice_relation()
    {
        $relation = $this->model->invoice();

        $this->assertBelongsToRelation($relation, $this->model, 'invoice_id');
    }

    public function test_student_relation()
    {
        $relation = $this->model->student();

        $this->assertBelongsToRelation($relation, $this->model, 'student_id');
    }
    
}