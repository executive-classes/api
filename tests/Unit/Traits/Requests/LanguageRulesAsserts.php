<?php

namespace Tests\Unit\Traits\Requests;

use Illuminate\Support\Facades\App;
use App\Enums\System\SystemLanguageEnum;
use App\Models\Eloquent\System\SystemLanguage\SystemLanguage;

trait LanguageRulesAsserts
{
    public function test_system_language_field()
    {
        $field = 'system_language_id';

        foreach (SystemLanguageEnum::getValues() as $value) {
            $this->assertPasses($field, [$field => $value]);
        }

        $this->assertNotPasses($field, [$field => 'invalid field']);
        $this->assertNotPasses($field, [$field => 21]);
        $this->assertNotPasses($field, [$field => null]);
    }

    public function test_change_app_language()
    {
        foreach (SystemLanguageEnum::getValues() as $value) {
            $this->db->shouldReceive('select')
                ->once()
                ->andReturn([SystemLanguage::factory(['id' => $value])->make()->toArray()]);
            $this->executePrepareForValidation(['system_language_id' => $value]);

            $this->assertEquals($value, App::getLocale());
        }
    }
}