<?php

namespace Database\Factories\Billing;

use App\Enums\Billing\BillerStatusEnum;
use App\Enums\Billing\PaymentIntervalEnum;
use App\Enums\Billing\PaymentMethodEnum;
use App\Enums\Billing\TaxTypeEnum;
use App\Models\Billing\Biller;
use App\Models\Billing\Address;
use App\Models\Billing\Customer;
use App\Models\Billing\PaymentInterval;
use App\Models\Billing\PaymentMethod;
use App\Traits\Factories\HasMultipleTaxTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

class BillerFactory extends Factory
{
    use HasMultipleTaxTypes;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Biller::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'name' => $this->faker->company,
            'tax_type_id' => TaxTypeEnum::CNPJ,
            'tax_code' => $this->faker->cnpj,
            'address_id' => Address::factory(),
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'phone_alt' => $this->faker->phoneNumber,
            'payment_interval_id' => PaymentInterval::inRandomOrder()->first(),
            'payment_method_id' => PaymentMethod::inRandomOrder()->first()
        ];
    }

    /**
     * Indicate that the biller is active.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'biller_status_id' => BillerStatusEnum::ACTIVE,
            ];
        });
    }

    /**
     * Indicate that the biller has a CNPJ.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cnpj(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::CNPJ,
                $this->faker->unique()->cnpj,
                $alt
            );
        });
    }

    /**
     * Indicate that the biller has a CPF.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function cpf(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::CPF,
                $this->faker->unique()->cpf,
                $alt
            );
        });
    }

    /**
     * Indicate that the biller has a RG.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function rg(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::RG,
                $this->faker->unique()->randomNumber(10),
                $alt
            );
        });
    }

    /**
     * Indicate that the biller has a IE.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function ie(bool $alt = false)
    {
        return $this->state(function (array $attributes) use ($alt) {
            return $this->getTaxTypeColumns(
                TaxTypeEnum::IE,
                $this->faker->unique()->randomNumber(10),
                $alt
            );
        });
    }

    /**
     * Indicate that the biller was charged every month.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function mensal()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::MENSAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 2 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bimestral()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::BIMESTRAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 3 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function trimestral()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::TRIMESTRAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 6 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function semestral()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::SEMESTRAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 12 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function anual()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::ANUAL,
            ];
        });
    }

    /**
     * Indicate that the biller was charged every 24 months.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bianual()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_interval_id' => PaymentIntervalEnum::BIANUAL,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with credit card.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function credit_card(string $token_id = null)
    {
        return $this->state(function (array $attributes) use ($token_id) {
            return [
                'payment_method_id' => PaymentMethodEnum::CREDIT_CARD,
                'token_id' => $token_id ?? config('test.paygo.token')
            ];
        });
    }

    /**
     * Indicate that the biller is payed with bank slip.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function bank_slip()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::BANK_SLIP,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with brazillian pix.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function pix()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::PIX,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with bank deposit.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function deposit()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::DEPOSIT,
            ];
        });
    }

    /**
     * Indicate that the biller is payed with eletronic transfer.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function transfer()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method_id' => PaymentMethodEnum::TRANSFER,
            ];
        });
    }
    
}
