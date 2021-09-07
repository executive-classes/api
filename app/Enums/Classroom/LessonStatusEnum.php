<?php

namespace App\Enums\Classroom;

use App\Enums\Enum;

final class LessonStatusEnum extends Enum
{
    const NEW = 'new';
    const IN_PROGRESS = 'in_progress';
    const FINISHED = 'finished';
    const ABANDONED = 'abandoned';
}