<?php

namespace App\Http\Resources\Billling\Employee;

use Carbon\Carbon;
use App\Http\Resources\Resource;
use App\Http\Resources\Billling\User\UserResource;
use App\Http\Resources\Billling\EmployeeStatus\EmployeeStatusResource;
use App\Http\Resources\Billling\EmployeePosition\EmployeePositionResource;

class EmployeeResource extends Resource
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
            'user' => new UserResource($this->user),
            'status' => new EmployeeStatusResource($this->status),
            'position' => new EmployeePositionResource($this->position),
        ];
    }
}

