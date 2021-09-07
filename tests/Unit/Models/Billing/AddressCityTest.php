<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\AddressCity\AddressCity;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class AddressCityTest extends ModelTestCase
{
    use HasFactoryAsserts;
    
    /**
     * @var AddressCity
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = AddressCity::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'address_city',
            'timestamps' => false
        ]);
    }

    public function test_state_relation()
    {
        $relation = $this->model->state();

        $this->assertBelongsToRelation($relation, $this->model, 'state_id');
    }
}
