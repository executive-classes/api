<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\CustomerStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\CustomerStatus\CustomerStatusCollection;
use App\Models\Billing\CustomerStatus;

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