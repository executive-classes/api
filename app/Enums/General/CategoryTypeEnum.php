<?php

namespace App\Enums\General;

use App\Enums\Enum;

final class CategoryTypeEnum extends Enum
{
    const COURSE = 'course';
    const MODULE = 'module';
    const LESSON = 'lesson';
    const TEST = 'test';
    const QUESTION = 'question';
    const MATERIAL = 'material';
}