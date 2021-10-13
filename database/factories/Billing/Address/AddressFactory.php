<?php

namespace Database\Factories\Billing\Address;

use Database\Factories\Factory;
use App\Enums\Billing\CountryEnum;
use App\Models\Eloquent\Billing\Address\Address;
use App\Models\Eloquent\Billing\AddressCountry\AddressCountry;

class AddressFactory extends Factory
{
    use AddressFactoryStates;
    
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->id(),
            'zip' => config('test.viacep.cep'),
            'street' => config('test.viacep.logradouro'),
            'number' => $this->faker->buildingNumber,
            'district' => config('test.viacep.bairro'),
            'city' => config('test.viacep.localidade'),
            'state' => config('test.viacep.uf'),
            'country' => CountryEnum::BR,
        ];
    }
}
