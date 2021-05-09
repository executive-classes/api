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
     * The State.
     * 
     * @var StateEnum|null
     */
    private $state;

    /**
     * Create the Tax Code rule.
     *
     * @param string|null $taxTypeId
     */
    public function __construct($taxTypeId = null, string $uf = null)
    {
        $this->taxType = TaxType::find($taxTypeId);
        $this->state = $uf ? StateEnum::fromValue($uf) : null;
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
        
        return $this->taxType->validate($value, $this->state);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        if (!$this->taxType) {
            return __('validation.tax_type');
        }

        return __('validation.tax', ['tax' => $this->taxType->name]);
    }
}

