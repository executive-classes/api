<?php

namespace Tests\Unit\Models\System;

use Illuminate\Support\Facades\App;
use Tests\Unit\Models\ModelTestCase;
use App\Models\Eloquent\System\SystemLanguage\SystemLanguage;
use App\Enums\System\SystemLanguageEnum;

class SystemLanguageTest extends ModelTestCase
{
    /**
     * @var SystemLanguage
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = SystemLanguage::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'system_language',
            'incrementing' => false,
            'keyType' => 'string',
            'timestamps' => false,
            'casts' => []
        ]);
    }

    public function test_update_system_locale_function()
    {
        $this->assertHasMethod(get_class($this->model), 'updateSystemLocale');

        foreach (SystemLanguageEnum::getValues() as $lang) {
            $this->model->id = $lang;

            $this->model->updateSystemLocale();

            $this->assertEquals($lang, App::getLocale());
        }
    }
}