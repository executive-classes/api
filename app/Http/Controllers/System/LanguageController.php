<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Resources\System\LanguageCollection;
use App\Models\System\SystemLanguage;

class LanguageController extends Controller
{
    public function index()
    {
        return new LanguageCollection(SystemLanguage::all());
    }
}