<?php

namespace Tests\Unit\Traits\Requests;

use Illuminate\Support\Facades\App;
use App\Enums\System\SystemLanguageEnum;
use App\Models\Eloquent\System\SystemLanguage\SystemLanguage;

trait LanguageRulesAsserts
{
    public function test_system_language_id_field()
    {
        $field = 'system_language_id';

        $this->assertRequiredRule($field, $this->checkRequiredAdditionalRule('systemLanguage'));
        $this->assertEnumRule($field, SystemLanguageEnum::getValues());
        $this->assertNotNullableRule($field);
    }

    public function test_change_app_language()
    {
        if ($this->changeLanguage()) {
            foreach (SystemLanguageEnum::getValues() as $value) {
                $this->db->shouldReceive('select')
                    ->once()
                    ->andReturn([SystemLanguage::factory(['id' => $value])->make()->toArray()]);
                $this->executePrepareForValidation(['system_language_id' => $value]);
    
                $this->assertEquals($value, App::getLocale());
            }
        }

        $this->assertTrue(true);
    }

    protected function changeLanguage()
    {
        return $this->changeLanguage ?? false;
    }
}