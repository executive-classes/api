<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use Tests\Unit\Traits\Models\HasFactoryAsserts;

class AddressCountryTest extends ModelTestCase
{
    use HasFactoryAsserts;

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
