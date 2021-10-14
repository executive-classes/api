<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Billing\TeacherStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\TeacherStatus\TeacherStatusCollection;
use App\Models\Eloquent\Billing\TeacherStatus\TeacherStatus;

class TeacherStatusController extends Controller
{
    public function index()
    {
        return new TeacherStatusCollection(
            TeacherStatus::whereIn('id', TeacherStatusEnum::getUpdatableValues())
                ->get()
        );
    }
}