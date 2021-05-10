<?php

namespace App\Providers;

use App\Apis\ViaCep\ViaCepClient;
use App\Enums\Billing\CountryEnum;
use App\Http\Controllers\Billling\AddressController;
use App\Services\Billing\Address\Contract\AddressMaker;
use App\Services\Billing\Address\Countries\BrazillianAddress;
use App\Services\Billing\Address\GenericAddress;
use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * Boot services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AddressMaker::class, $this->getAddressMakerClass());
    }

    private function getAddressMakerClass(): string
    {
        if (request()->get('country', CountryEnum::BR) != CountryEnum::BR) {
            return GenericAddress::class;
        }

        return BrazillianAddress::class;
    }
}
