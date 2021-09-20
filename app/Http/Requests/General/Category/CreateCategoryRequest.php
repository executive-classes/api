<?php

namespace App\Http\Requests\General\Category;

use App\Enums\General\CategoryTypeEnum;
use App\Http\Requests\Request;
use BenSampo\Enum\Rules\EnumValue;

class CreateCategoryRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'name' => 'required|min:3',
            'description' => 'required|string',
            'category_type_id' => [
                'required',
                new EnumValue(CategoryTypeEnum::class)
            ],
            'parent_id' => 'sometimes|nullable|numeric|exists:category,id',
        ];
    }
}