<?php

namespace App\Http\Controllers\Billling;

use App\Http\Controllers\Controller;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Enums\Billing\BillerStatusEnum;
use App\Models\Eloquent\Billing\Biller\BillerFilters;
use App\Http\Resources\Billling\Biller\BillerResource;
use App\Http\Resources\Billling\Biller\BillerCollection;
use App\Http\Requests\Billing\Biller\CreateBillerRequest;
use App\Http\Requests\Billing\Biller\UpdateBillerRequest;

class BillerController extends Controller
{
    public function index(BillerFilters $filter)
    {
        return new BillerCollection(Biller::filter($filter)->get());
    }

    public function store(CreateBillerRequest $request)
    {
        $biller = new Biller($request->validated());
        $biller->save();
        
        return new BillerResource($biller->refresh());
    }

    public function show(Biller $biller)
    {
        return new BillerResource($biller);
    }
    
    public function update(UpdateBillerRequest $request, Biller $biller)
    {
        $biller->fill($request->validated());
        $biller->save();

        return new BillerResource($biller);
    }

    public function cancel(Biller $biller)
    {
        $biller->biller_status_id = BillerStatusEnum::CANCELED;
        $biller->save();

        return new BillerResource($biller);
    }
}