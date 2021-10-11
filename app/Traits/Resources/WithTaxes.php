<?php

namespace App\Traits\Resources;

use App\Http\Resources\Billing\Tax\TaxResource;
use App\Models\Eloquent\Billing\TaxType\TaxType;

trait WithTaxes
{
    private function makeTax($taxType, $tax)
    {
        if (!$taxType instanceof TaxType) {
            return $taxType;
        }

        $taxType->code = $taxType->mask($tax);
        return new TaxResource($taxType);
    }
}