<?php

namespace App\Http\Resources\Billing\Student;

use Carbon\Carbon;
use App\Http\Resources\Resource;
use App\Http\Resources\Billing\User\UserResource;
use App\Http\Resources\Billing\Customer\CustomerResource;
use App\Http\Resources\Billing\StudentStatus\StudentStatusResource;

class StudentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            'customer' => new CustomerResource($this->customer),
            'user' => new UserResource($this->user),
            'status' => new StudentStatusResource($this->status)
        ];
    }
}