<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\EmployeeStatus\EmployeeStatusCollection;
use App\Models\Billing\EmployeeStatus;

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
