<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\EmployeeStatus\EmployeeStatusCollection;
use App\Models\Eloquent\Billing\EmployeeStatus\EmployeeStatus;

class EmployeeStatusController extends Controller
{
    public function index()
    {
        return new EmployeeStatusCollection(
            EmployeeStatus::whereIn('id', EmployeeStatusEnum::getUpdatableValues())
                ->get()
        );
    }
}
