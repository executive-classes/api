<?php

namespace App\Traits\Authentication;

trait CanChangeLanguage
{
    /**
     * Change the application language.
     *
     * @return void
     */
    public function changeLanguage()
    {
        $this->language->updateSystemLocale();
    }

    /**
     * Set a new language.
     *
     * @param string $language
     * @return void
     */
    public function setLanguage(string $language)
    {
        $this->system_language_id = $language;
    }
}