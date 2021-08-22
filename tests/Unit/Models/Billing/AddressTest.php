<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\Address;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class AddressTest extends ModelTestCase
{
    use HasFactoryAsserts;
    use HasFilterAsserts;

    /**
     * @var Address
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = Address::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'address',
            'fillable' => [
                'zip',
                'street',
                'number',
                'complement',
                'district',
                'city',
                'state',
                'country'
            ]
        ]);
    }

    public function test_customer_relation()
    {
        $relation = $this->model->customer();

        $this->assertHasOneRelation($relation, $this->model, 'address_id');
    }

    public function test_biller_relation()
    {
        $relation = $this->model->biller();

        $this->assertHasOneRelation($relation, $this->model, 'address_id');
    }

    public function test_country_relation()
    {
        $relation = $this->model->countryModel();

        $this->assertBelongsToRelation($relation, $this->model,'country', 'short_name');
    }
}