<?php

namespace App\Traits\Resources;

use App\Http\Resources\Billling\Tax\TaxResource;
use App\Models\Billing\TaxType;

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