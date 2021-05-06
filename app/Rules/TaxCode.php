<?php

namespace App\Rules;

use App\Enums\Billing\StateEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Billing\TaxType;
use Illuminate\Contracts\Validation\Rule;

class TaxCode implements Rule
{
    /**
     * The Tax Type
     * 
     * @var TaxType
     */
    private $taxType;

    /**
     * Create the Tax Code rule.
     *
     * @param string|null $taxTypeId
     */
    public function __construct($taxTypeId = null)
    {
        $this->taxType = TaxType::find($taxTypeId);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->taxType) {
            return false;
        }
        
        $state = $this->taxType->id == TaxTypeEnum::IE
            ? StateEnum::fromValue(request()->get('uf'))
            : null;

        return $this->taxType->validate($value, $state);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        return __('validation.tax', ['tax' => $this->taxType->name]);
    }
}

