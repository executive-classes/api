<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\Biller;
use Tests\Unit\Models\HasFactoryAsserts;
use Tests\Unit\Models\HasFilterAsserts;
use Tests\Unit\Models\HasPhoneAsserts;
use Tests\Unit\Models\HasTaxAsserts;
use Tests\Unit\Models\ModelTestCase;

class BillerTest extends ModelTestCase
{
    use HasFactoryAsserts, HasFilterAsserts, HasTaxAsserts, HasPhoneAsserts;

    /**
     * @var Biller
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Biller::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'biller',
            'fillable' => [
                'customer_id',
                'biller_status_id',
                'name',
                'tax_type_id',
                'tax_code',
                'tax_type_alt_id',
                'tax_code_alt',
                'address_id',
                'email',
                'phone',
                'phone_alt',
                'payment_interval_id',
                'payment_method_id'
            ]
        ]);
    }

    public function test_customer_relation()
    {
        $relation = $this->model->customer();

        $this->assertBelongsToRelation($relation, $this->model, 'customer_id');
    }

    public function test_tax_type_relation()
    {
        $relation = $this->model->taxType();

        $this->assertBelongsToRelation($relation, $this->model, 'tax_type_id');
    }

    public function test_tax_type_alt_relation()
    {
        $relation = $this->model->taxTypeAlt();

        $this->assertBelongsToRelation($relation, $this->model, 'tax_type_alt_id');
    }

    public function test_status_relation()
    {
        $relation = $this->model->status();

        $this->assertBelongsToRelation($relation, $this->model, 'biller_status_id');
    }

    public function test_address_relation()
    {
        $relation = $this->model->address();

        $this->assertBelongsToRelation($relation, $this->model, 'address_id');
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

    public function test_students_relation()
    {
        $relation = $this->model->students();

        $this->assertHasManyRelation($relation, $this->model, 'biller_id');
    }

    public function test_collections_relation()
    {
        $relation = $this->model->collections();

        $this->assertHasManyRelation($relation, $this->model, 'biller_id');
    }
}