<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Eloquent\Billing\AddressState\AddressState;
use Tests\Unit\Models\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class AddressStateTest extends ModelTestCase
{
    use HasFactoryAsserts;

    /**
     * @var AddressState
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = AddressState::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'address_state',
            'timestamps' => false
        ]);
    }

    public function test_cities_relation()
    {
        $relation = $this->model->cities();

        $this->assertHasManyRelation($relation, $this->model, 'state_id');
    }
}