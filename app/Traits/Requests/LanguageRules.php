<?php

namespace App\Traits\Requests;

use BenSampo\Enum\Rules\EnumValue;
use App\Enums\System\SystemLanguageEnum;
use App\Models\System\SystemLanguage\SystemLanguage;

trait LanguageRules
{
    public function getSystemLanguageRules(string $required = 'sometimes')
    {
        return [
            'system_language_id' => [
                $required, 
                'string',
                new EnumValue(SystemLanguageEnum::class)
            ]
        ];
    }

    public function changeLanguageFromRequest(string $language = null)
    {
        if (!$language && !SystemLanguageEnum::hasValue($language)) {
            return;
        }

        SystemLanguage::findOrFail($this->language)->updateSystemLocale();
    }
}