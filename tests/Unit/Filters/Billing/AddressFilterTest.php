<?php

namespace Tests\Unit\Filters\Billing;

use App\Models\Billing\Address\AddressFilters;
use Tests\Unit\Filters\FilterTestCase;

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
        $this->assertHasMethod($this->filter, 'zip');
    }

    public function test_street_filter()
    {
        $this->assertHasMethod($this->filter, 'street');
    }

    public function test_number_filter()
    {
        $this->assertHasMethod($this->filter, 'number');
    }

    public function test_complement_filter()
    {
        $this->assertHasMethod($this->filter, 'complement');
    }

    public function test_district_filter()
    {
        $this->assertHasMethod($this->filter, 'district');
    }

    public function test_city_filter()
    {
        $this->assertHasMethod($this->filter, 'city');
    }

    public function test_state_filter()
    {
        $this->assertHasMethod($this->filter, 'state');
    }

    public function test_country_filter()
    {
        $this->assertHasMethod($this->filter, 'country');
    }
}