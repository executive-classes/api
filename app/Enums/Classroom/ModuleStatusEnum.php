<?php

namespace App\Enums\Classroom;

use BenSampo\Enum\Enum;

final class ModuleStatusEnum extends Enum
{
    const NEW = 'new';
    const IN_PROGRESS = 'in_progress';
    const FINISHED = 'finished';
    const APPROVED = 'approved';
    const DISAPPROVED = 'disapproved';
    const ABANDONED = 'abandoned';
}