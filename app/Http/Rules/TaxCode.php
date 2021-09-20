<?php

namespace App\Http\Rules;

use App\Enums\Billing\StateEnum;
use App\Models\Eloquent\Billing\TaxType\TaxType;
use Illuminate\Contracts\Validation\Rule;

class TaxCode implements Rule
{
    /**
     * The Tax Type
     * 
     * @var string|null
     */
    private $taxTypeId;

    /**
     * The State.
     * 
     * @var string|null
     */
    private $uf;

    /**
     * Create the Tax Code rule.
     *
     * @param string|null $taxTypeId
     * @param string|null $uf
     */
    public function __construct($taxTypeId = null, string $uf = null)
    {
        $this->taxTypeId = $taxTypeId;
        $this->uf = $uf;
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
        $taxType = TaxType::find($this->taxTypeId);
        $state = $this->uf ? StateEnum::fromValue($this->uf) : null;

        if (!$taxType) {
            return false;
        }

        if (!$value) {
            return false;
        }
        
        return $taxType->validate($value, $state);
    }

    /**
     * Get the validation error message.
     *
     * @return string|array
     */
    public function message()
    {
        if (!$this->taxTypeId) {
            return __('validation.tax_type');
        }

        $taxType = TaxType::find($this->taxTypeId);
        return __('validation.tax', ['tax' => $taxType->name]);
    }
}

