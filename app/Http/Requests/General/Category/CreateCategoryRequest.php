<?php

namespace App\Http\Requests\General\Category;

use App\Enums\General\CategoryTypeEnum;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'description' => 'required',
            'category_type_id' => [
                'required',
                new EnumValue(CategoryTypeEnum::class)
            ],
            'parent_id' => 'sometimes|nullable|numeric|exists:category,id',
        ];
    }
}