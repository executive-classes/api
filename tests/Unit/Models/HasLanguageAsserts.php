<?php

namespace Tests\Unit\Models;

trait HasLanguageAsserts
{
    public function test_changeLanguage_function()
    {
        $this->assertHasMethod(get_class($this->model), 'changeLanguage');
    }
    
    public function test_setLanguage_function()
    {
        $this->assertHasMethod(get_class($this->model), 'setLanguage');
    }
}