<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\System\SystemLanguage\SystemLanguage;
use App\Http\Resources\System\SystemLanguage\SystemLanguageCollection;

class LanguageController extends Controller
{
    public function index()
    {
        return new SystemLanguageCollection(SystemLanguage::all());
    }
}