<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\AddressCity;
use Tests\Unit\Models\ModelTestCase;

class AddressCityTest extends ModelTestCase
{
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
