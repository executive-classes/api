<?php

namespace App\Traits\Providers\PayGo;

use Carbon\Carbon;

trait CreditCartProvider
{
    public function makeCreditCard(bool $valid = true)
    {
        $brand = $this->getBrand($valid);
        $expirationDate = $this->getExpirationDate($valid);
        
        return [
            "brand" => $brand,
            "number" => $this->faker()->creditCardNumber($brand),
            "holderName" => $this->faker()->name(),
            "expirationMonth" => $expirationDate->format('m'),
            "expirationYear" => $expirationDate->format('Y')
        ];
    }

    private function getBrand(bool $valid = true)
    {
        return $this->faker()->randomElement(
            $valid ? config('test.paygo.brands.valid') : config('test.paygo.brands.invalid')
        );
    }

    private function getExpirationDate(bool $valid = true, string $format = 'm/y')
    {
        return Carbon::createFromFormat($format, $this->faker()->creditCardExpirationDateString($valid, $format));
    }
}