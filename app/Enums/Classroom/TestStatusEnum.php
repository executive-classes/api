<?php

namespace App\Enums\Classroom;

use App\Enums\Enum;

final class TestStatusEnum extends Enum
{
    const NEW = 'new';
    const READY = 'ready';
    const STARTED = 'started';
    const FINISHED = 'finished';
    const GRADED = 'graded';
    const CANCELED = 'canceled';
}