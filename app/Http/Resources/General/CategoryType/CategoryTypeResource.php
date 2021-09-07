<?php

namespace App\Http\Resources\General\CategoryType;

use App\Enums\General\CategoryTypeEnum;
use App\Http\Resources\EnumResource;

class CategoryTypeResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = CategoryTypeEnum::class;

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
            'name' => $this->name
        ];
    }
}
