<?php

namespace Tests\Providers\Billing;

use App\Enums\System\SystemLanguageEnum;
use App\Models\Billing\User\User;
use Closure;

trait UserProvider
{
    /**
     * Providers
     */

    public function getUser()
    {
        return [
            [$this->getUserFunction()]
        ];
    }

    public function getInvalidCrossAuthUsers()
    {
        return [
            [$this->getInvalidCrossAuthUsersFunction()]
        ];
    }

    public function getUserWithMultipleLanguages()
    {
        return [
            'user-with-english-language' => [$this->getUserWithMultipleLanguagesFunction(SystemLanguageEnum::EN())],
            'user-with-portuguese-language' => [$this->getUserWithMultipleLanguagesFunction(SystemLanguageEnum::PT_BR())]
        ];
    }

    /**
     * Providers Functions
     */

    private function getUserFunction(): Closure
    {
        return function () { return [$this->makeUser()]; };
    }

    private function getInvalidCrossAuthUsersFunction(): Closure
    {
        return function () { return [$this->makeUser(), $this->makeUser()]; };
    }

    private function getUserWithMultipleLanguagesFunction(SystemLanguageEnum $language): Closure
    {
        return function () use ($language) { return [$this->makeUserWithLanguage($language)]; };
    }

    /**
     * Makers
     */

    public function makeUser(): User
    {
        return User::factory()->create();
    }

    public function makeUserWithLanguage(SystemLanguageEnum $language): User
    {
        return User::factory()->{$language->value}()->create();
    }
}
