<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\Invoice\Invoice;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class InvoiceTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var Invoice
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Invoice::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'invoice',
            'fillable' => [
                'invoice_status_id',
                'xml',
                'receipt',
                'error_message'
            ]
        ]);
    }

    public function test_biller_relation()
    {
        $relation = $this->model->biller();

        $this->assertHasOneThroughRelation($relation, $this->model, 'collection_id', 'biller_id');
    }

    public function test_collection_relation()
    {
        $relation = $this->model->collection();

        $this->assertBelongsToRelation($relation, $this->model, 'collection_id');
    }

    public function test_itens_relation()
    {
        $relation = $this->model->itens();

        $this->assertHasManyRelation($relation, $this->model, 'invoice_id');
    }
}