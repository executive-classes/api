<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Billing\CustomerStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\CustomerStatus\CustomerStatusCollection;
use App\Models\Eloquent\Billing\CustomerStatus\CustomerStatus;

class CustomerStatusController extends Controller
{
    public function index()
    {
        return new CustomerStatusCollection(
            CustomerStatus::whereIn('id', CustomerStatusEnum::getUpdatableValues())
                ->get()
        );
    }
}