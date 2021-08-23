<?php

namespace App\Http\Requests\General\Category;

use App\Enums\General\CategoryTypeEnum;
use App\Http\Requests\Request;
use BenSampo\Enum\Rules\EnumValue;

class UpdateCategoryRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'name' => 'sometimes|min:3',
            'description' => 'sometimes',
            'category_type_id' => [
                'sometimes',
                new EnumValue(CategoryTypeEnum::class)
            ],
            'parent_id' => 'sometimes|nullable|numeric|exists:category,id',
        ];
    }
}