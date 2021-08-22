<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\BillerStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billling\BillerStatus\BillerStatusCollection;
use App\Models\Billing\BillerStatus\BillerStatus;

class BillerStatusController extends Controller
{
    public function index()
    {
        return new BillerStatusCollection(
            BillerStatus::whereIn('id', BillerStatusEnum::getUpdatableValues())
                ->get()
        );
    }
    
}