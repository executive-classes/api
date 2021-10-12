<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;
use App\Models\Eloquent\Billing\Address\Address;

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