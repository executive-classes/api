<?php

namespace Tests\Unit\Models\Billing;

use App\Models\Billing\AddressCountry;
use Tests\Unit\Models\ModelTestCase;

class AddressCountryTest extends ModelTestCase
{
    /**
     * @var AddressCountry
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = AddressCountry::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'address_country',
            'timestamps' => false
        ]);
    }
}
