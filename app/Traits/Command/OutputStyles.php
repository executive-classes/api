<?php

namespace App\Traits\Command;

trait OutputStyles
{
    public function block($messages, ?string $type = null, ?string $style = null, string $prefix = ' ', bool $padding = false, bool $escape = true)
    {
        $this->output->block($messages, $type, $style, $prefix, $padding, $escape);
    }
}

