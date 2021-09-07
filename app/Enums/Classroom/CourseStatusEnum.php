<?php

namespace App\Enums\Classroom;

use App\Enums\Enum;

final class CourseStatusEnum extends Enum
{
    const NEW = 'new';
    const IN_PROGRESS = 'in_progress';
    const FINISHED = 'finished';
    const APPROVED = 'approved';
    const DISAPPROVED = 'disapproved';
    const ABANDONED = 'abandoned';
}