<?php

namespace App\Http\Controllers\Billling;

use App\Enums\Billing\CustomerStatusEnum;
use App\Filters\Billing\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Billing\Customer\CreateCustomerRequest;
use App\Http\Requests\Billing\Customer\UpdateCustomerRequest;
use App\Http\Resources\Billling\CustomerCollection;
use App\Http\Resources\Billling\CustomerResource;
use App\Models\Billing\Customer;

class CustomerController extends Controller
{
    public function index(CustomerFilter $filter)
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