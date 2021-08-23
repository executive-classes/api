<?php

namespace Database\Factories\Billing\User;

use Carbon\Carbon;
use App\Enums\Billing\TaxTypeEnum;
use App\Enums\System\SystemLanguageEnum;
use App\Models\Eloquent\Billing\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Factories\Billing\User\UserFactoryStates;

class UserFactory extends Factory
{
    use UserFactoryStates;
    
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
}
