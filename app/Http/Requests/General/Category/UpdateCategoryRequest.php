<?php

namespace App\Http\Requests\General\Category;

use App\Enums\General\CategoryTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
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