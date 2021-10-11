<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Billing\StudentStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\StudentStatus\StudentStatusCollection;
use App\Models\Eloquent\Billing\StudentStatus\StudentStatus;

class StudentStatusController extends Controller
{
    public function index()
    {
        return new StudentStatusCollection(
            StudentStatus::whereIn('id', StudentStatusEnum::getUpdatableValues())
                ->get()
        );
    }
}