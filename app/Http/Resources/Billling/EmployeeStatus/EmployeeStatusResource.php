<?php

namespace App\Http\Resources\Billling\EmployeeStatus;

use App\Enums\Billing\EmployeeStatusEnum;
use App\Http\Resources\EnumResource;

class EmployeeStatusResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = EmployeeStatusEnum::class;

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
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
