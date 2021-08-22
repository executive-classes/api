<?php

namespace Database\Factories\Billing\User;

use App\Enums\Billing\TaxTypeEnum;
use App\Enums\System\SystemLanguageEnum;
use App\Models\Billing\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => config('test.user.password'),
            'tax_type_id' => TaxTypeEnum::CPF,
            'tax_code' => $this->faker->cpf,
            'system_language_id' => SystemLanguageEnum::EN
        ];
    }

    /**
     * Indicate that the user has a cpf.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cpf()
    {
        return $this->state(function (array $attributes) {
            return [
                'tax_type_id' => TaxTypeEnum::CPF,
                'tax_code' => $this->faker->cpf
            ];
        });
    }

    /**
     * Indicate that the user has a rg.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function rg()
    {
        return $this->state(function (array $attributes) {
            return [
                'tax_type_id' => TaxTypeEnum::RG,
                'tax_code' => $this->faker->randomNumber(10)
            ];
        });
    }

    /**
     * Indicate that the user use the system in english.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function en()
    {
        return $this->state(function (array $attributes) {
            return [
                'system_language_id' => SystemLanguageEnum::EN
            ];
        });
    }

    /**
     * Indicate that the user use the system in portuguese (brazillian).
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pt_BR()
    {
        return $this->state(function (array $attributes) {
            return [
                'system_language_id' => SystemLanguageEnum::PT_BR
            ];
        });
    }
}
