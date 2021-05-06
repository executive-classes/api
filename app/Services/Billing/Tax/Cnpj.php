<?php

namespace App\Services\Billing\Tax;

use App\Services\Billing\Tax\Contract\Tax;

class Cnpj extends Tax
{
    /**
     * CNPJ Mask.
     * 
     * @var string
     */
    public $mask = '##.###.###/####-##';

    /**
     * Validate the CNPJ.
     *
     * @param string $tax
     * @return boolean
     * @source https://github.com/geekcom/validator-docs/blob/master/src/validator-docs/Rules/Cnpj.php
     */
    public function validate(string $tax): bool
    {
        $c = $this->sanitize($tax);

        if (mb_strlen($c) != 14 || preg_match("/^{$c[0]}{14}$/", $c)) {
            return false;
        }

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for (
            $i = 0, $n = 0; $i < 12; $n += $c[$i] * $b[++$i]
        ) {
        }

        if ($c[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        for (
            $i = 0, $n = 0; $i <= 12; $n += $c[$i] * $b[$i++]
        ) {
        }

        if ($c[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
            return false;
        }

        return true;
    }
}