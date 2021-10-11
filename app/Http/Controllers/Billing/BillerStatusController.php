<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Billing\BillerStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\BillerStatus\BillerStatusCollection;
use App\Models\Eloquent\Billing\BillerStatus\BillerStatus;

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