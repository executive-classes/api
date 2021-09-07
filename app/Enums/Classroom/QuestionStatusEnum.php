<?php

namespace App\Enums\Classroom;

use App\Enums\Enum;

final class QuestionStatusEnum extends Enum
{
    const READY = 'ready';
    const STARTED = 'started';
    const ANSWERED = 'finished';
    const GRADED = 'graded';
}