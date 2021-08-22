<?php

namespace App\Models\System\SystemLanguage;

use Illuminate\Support\Facades\App;

trait SystemLanguageFunctions
{
    /**
     * Update system locale.
     *
     * @return void
     */
    public function updateSystemLocale()
    {
        App::setLocale($this->id);
    }
}