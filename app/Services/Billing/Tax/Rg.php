<?php

namespace App\Services\Billing\Tax;

use App\Services\Billing\Tax\Contract\Tax;

class Rg extends Tax
{
    /**
     * RG Mask.
     * 
     * @var string
     */
    public $mask = '##.###.###-X';

    /**
     * Validate the RG.
     *
     * @param string $tax
     * @return boolean
     */
    public function validate(string $tax): bool
    {
        $r = $this->sanitize($tax, '/(?!(\d|x))\D/');

        if (strlen($r) != 9 || !preg_match("/^(\d{8})(\d|x)$/", $r)) {
            return false;
        }

        $t = 0;
        $m = 9;

        for ($i=7; $i >= 0; $i--) { 
            $t += $r[$i]*$m;
            $m--;
        }

        $l = $r[8] == 'x' ? 10 : $r[8];

        return ( ($t + $l * 100) % 11 ) === 0;
    }
}
