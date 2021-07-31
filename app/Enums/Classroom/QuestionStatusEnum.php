<?php

namespace App\Enums\Classroom;

use BenSampo\Enum\Enum;

final class QuestionStatusEnum extends Enum
{
    const READY = 'ready';
    const STARTED = 'started';
    const ANSWERED = 'finished';
    const GRADED = 'graded';
}