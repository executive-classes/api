<?php

namespace Tests\Unit\Http\Requests\Billing\TaxType;

use App\Http\Requests\Billing\TaxType\ValidateTaxTypeRequest;
use Tests\Unit\Http\Requests\RequestTestCase;
use Tests\Unit\Traits\Requests\TaxRulesAsserts;

class ValidateTaxTypeRequestTest extends RequestTestCase
{
    use TaxRulesAsserts;
    
    /**
     * @var string
     */
    protected $requestClass = ValidateTaxTypeRequest::class;
}