<?php

namespace App\Services\Billing\Tax;

use App\Enums\Billing\StateEnum;
use App\Services\Billing\Tax\Contract\Tax;
use Pezzetti\InscricaoEstadual\Util\Mask;
use Pezzetti\InscricaoEstadual\Util\Validator;

class Ie extends Tax
{
    /**
     * Validate the IE.
     *
     * @param string $tax
     * @param StateEnum $state
     * @return boolean
     */
    public function validate(string $tax, StateEnum $state = null): bool
    {
        return Validator::check($state->value, $tax);
    }

    /**
     * Mask the IE.
     *
     * @param string $tax
     * @param StateEnum $state
     * @return string
     */
    public function mask(string $tax, StateEnum $state = null): string
    {
        return Mask::getIEForUF($state->value, $tax);
    }
    
}
