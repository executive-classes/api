<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\Customer;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasTaxAsserts;
use Tests\Unit\Traits\Models\HasPhoneAsserts;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class CustomerTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;
    use HasTaxAsserts;
    use HasPhoneAsserts;

    /**
     * @var Customer
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Customer::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'customer',
            'fillable' => [
                'customer_status_id',
                'name',
                'tax_type_id',
                'tax_code',
                'tax_type_alt_id',
                'tax_code_alt',
                'address_id',
                'email',
                'phone',
                'phone_alt'
            ]
        ]);
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

        $this->assertBelongsToRelation($relation, $this->model, 'customer_status_id');
    }

    public function test_address_relation()
    {
        $relation = $this->model->address();

        $this->assertBelongsToRelation($relation, $this->model, 'address_id');
    }

    public function test_billers_relation()
    {
        $relation = $this->model->billers();

        $this->assertHasManyRelation($relation, $this->model, 'customer_id');
    }
    
    public function test_students_relation()
    {
        $relation = $this->model->students();

        $this->assertHasManyRelation($relation, $this->model, 'customer_id');
    }
}