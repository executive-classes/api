<?php

namespace App\Http\Resources\Billling\StudentStatus;

use App\Enums\Billing\StudentStatusEnum;
use App\Http\Resources\EnumResource;

class StudentStatusResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = StudentStatusEnum::class;

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
            'description' => $this->description
        ];
    }
}
