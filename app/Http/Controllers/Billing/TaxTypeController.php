<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\TaxType\ValidateTaxTypeRequest;
use App\Http\Resources\Billing\Tax\TaxTypeCollection;
use App\Models\Eloquent\Billing\TaxType\TaxType;

class TaxTypeController extends Controller
{
    /**
     * @var TaxType
     */
    private $taxType;

    /**
     * @param TaxType $taxType
     */
    public function __construct(TaxType $taxType)
    {
        $this->taxType = $taxType;
    }

    public function index()
    {
        return new TaxTypeCollection(TaxType::all());
    }

    public function validation(ValidateTaxTypeRequest $request)
    {
        $validation = $this->taxType->find($request->tax_type_id)->validate(
            $request->get('tax_code'),
            $request->get('uf', null)
        );

        return api()->ok($validation);
    }
}
