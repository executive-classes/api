<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\TaxType\ValidateTaxTypeRequest;
use App\Http\Resources\Billling\Tax\TaxTypeCollection;
use App\Models\Eloquent\Billing\TaxType\TaxType;

class TaxTypeController extends Controller
{
    public function index()
    {
        return new TaxTypeCollection(TaxType::all());
    }

    public function validation(ValidateTaxTypeRequest $request)
    {
        $validation = TaxType::find($request->tax_type_id)->validate(
            $request->tax_code,
            $request->get('uf', null)
        );

        return api()->ok($validation);
    }
}
