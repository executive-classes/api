<?php
namespace App\Console;

use App\Traits\Command\OutputStyles;
use Illuminate\Console\Command as BaseCommand;

class Command extends BaseCommand
{
    use OutputStyles;
}

