<?php

namespace App\Services\Billing\Tax;

use App\Services\Billing\Tax\Contract\Tax;

class Cpf extends Tax
{
    /**
     * CPF Mask.
     * 
     * @var string
     */
    public $mask = '###.###.###-##';

    /**
     * Validate the CPF.
     *
     * @param string $tax
     * @return boolean
     * @source https://github.com/geekcom/validator-docs/blob/master/src/validator-docs/Rules/Cpf.php
     */
    public function validate(string $tax): bool
    {
        $c = $this->sanitize($tax);

        if (mb_strlen($c) != 11 || preg_match("/^{$c[0]}{11}$/", $c)) {
            return false;
        }

        for (
            $s = 10, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--
        ) {
        }

        if ($c[9] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for (
            $s = 11, $n = 0, $i = 0; $s >= 2; $n += $c[$i++] * $s--
        ) {
        }

        if ($c[10] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}