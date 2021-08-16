<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\Collection;
use Tests\Unit\Models\HasFactoryAsserts;
use Tests\Unit\Models\HasPayGoAsserts;
use Tests\Unit\Models\ModelTestCase;

class CollectionTest extends ModelTestCase
{
    use HasFactoryAsserts, HasPayGoAsserts;

    /**
     * @var Collection
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Collection::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'collection',
            'fillable' => [
                'expire_at',
                'amount',
                'description',
                'truncatedDescription',
                'payment_interval_id',
                'payment_method_id',
                'token_id'
            ]
        ]);
    }

    public function test_customer_relation()
    {
        $relation = $this->model->customer();

        $this->assertHasOneThroughRelation($relation, $this->model, 'biller_id', 'customer_id');
    }

    public function test_biller_relation()
    {
        $relation = $this->model->biller();

        $this->assertBelongsToRelation($relation, $this->model, 'biller_id');
    }

    public function test_status_relation()
    {
        $relation = $this->model->status();

        $this->assertBelongsToRelation($relation, $this->model, 'collection_status_id');
    }

    public function test_payment_method_relation()
    {
        $relation = $this->model->paymentMethod();

        $this->assertBelongsToRelation($relation, $this->model, 'payment_method_id');
    }

    public function test_payment_interval_relation()
    {
        $relation = $this->model->interval();

        $this->assertBelongsToRelation($relation, $this->model, 'payment_interval_id');
    }

    public function test_invoices_relation()
    {
        $relation = $this->model->invoices();

        $this->assertHasManyRelation($relation, $this->model, 'collection_id');
    }

    public function test_itens_relation()
    {
        $relation = $this->model->itens();

        $this->assertHasManyRelation($relation, $this->model, 'collection_id');
    }
}