<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Enums\Billing\CustomerStatusEnum;
use App\Models\Eloquent\Billing\Customer\Customer;
use App\Models\Eloquent\Billing\Customer\CustomerFilters;
use App\Http\Resources\Billing\Customer\CustomerResource;
use App\Http\Resources\Billing\Customer\CustomerCollection;
use App\Http\Requests\Billing\Customer\CreateCustomerRequest;
use App\Http\Requests\Billing\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function index(CustomerFilters $filter)
    {
        return new CustomerCollection(Customer::filter($filter)->get());
    }

    public function store(CreateCustomerRequest $request)
    {
        $customer = new Customer($request->validated());
        /** @todo Criar biller */
        $customer->save();
        
        return new CustomerResource($customer->refresh());
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }
    
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->fill($request->validated());
        $customer->save();

        return new CustomerResource($customer);
    }

    public function cancel(Customer $customer)
    {
        $customer->customer_status_id = CustomerStatusEnum::CANCELED;
        $customer->save();

        return new CustomerResource($customer);
    }
}