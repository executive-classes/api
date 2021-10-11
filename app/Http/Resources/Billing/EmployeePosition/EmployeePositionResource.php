<?php

namespace App\Http\Resources\Billing\EmployeePosition;

use App\Enums\Billing\EmployeePositionEnum;
use App\Http\Resources\EnumResource;

class EmployeePositionResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = EmployeePositionEnum::class;

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
            'parent' => $this->parent,
            'children' => $this->children
        ];
    }
}
