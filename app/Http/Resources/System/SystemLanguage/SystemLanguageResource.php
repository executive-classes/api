<?php

namespace App\Http\Resources\System\SystemLanguage;

use App\Enums\System\SystemLanguageEnum;
use App\Http\Resources\EnumResource;

class SystemLanguageResource extends EnumResource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = SystemLanguageEnum::class;

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
