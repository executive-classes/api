<?php

namespace Tests\Unit\Models\Eloquent\Billing\Address;

use App\Models\Eloquent\Billing\Address\AddressFilters;
use Tests\Unit\Models\Eloquent\FilterTestCase;

class AddressFilterTest extends FilterTestCase
{
    /**
     * @var AddressFilters
     */
    protected $filter;

    /**
     * @var string
     */
    protected $filterClass = AddressFilters::class;

    public function test_zip_filter()
    {
        $this->assertModelFilter('zip');
    }

    public function test_street_filter()
    {
        $this->assertModelFilter('street');
    }

    public function test_number_filter()
    {
        $this->assertModelFilter('number');
    }

    public function test_complement_filter()
    {
        $this->assertModelFilter('complement');
    }

    public function test_district_filter()
    {
        $this->assertModelFilter('district');
    }

    public function test_city_filter()
    {
        $this->assertModelFilter('city');
    }

    public function test_state_filter()
    {
        $this->assertModelFilter('state');
    }

    public function test_country_filter()
    {
        $this->assertModelFilter('country');
    }
}