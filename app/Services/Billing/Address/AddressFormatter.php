<?php

namespace App\Services\Billing\Address;

use App\Models\Billing\Address\Address;
use CommerceGuys\Addressing\Address as AddressingAddress;
use CommerceGuys\Addressing\AddressFormat\AddressFormatRepository;
use CommerceGuys\Addressing\Country\CountryRepository;
use CommerceGuys\Addressing\Formatter\PostalLabelFormatter;
use CommerceGuys\Addressing\Subdivision\SubdivisionRepository;

class AddressFormatter
{
    /**
     * The formatter options.
     * 
     * @var array
     */
    protected static $options = [
        'origin_country' => 'BR',
        'locale' => 'pt',
        'html' => false
    ];

    /**
     * Format a address
     *
     * @param Address $address
     * @return string
     */
    public static function format(Address $address): string
    {
        $addressingAddress = self::makeAddress($address);
        $formatter = self::makeFormatter();

        $formattedAddress = $formatter->format($addressingAddress, self::$options);

        return preg_replace('/\n/', ' / ', $formattedAddress);
    }

    /**
     * Make the Fromatter
     *
     * @return PostalLabelFormatter
     */
    protected static function makeFormatter(): PostalLabelFormatter
    {
        $addressFormatRepository = new AddressFormatRepository();
        $countryRepository = new CountryRepository();
        $subdivisionRepository = new SubdivisionRepository();

        return new PostalLabelFormatter(
            $addressFormatRepository, 
            $countryRepository, 
            $subdivisionRepository
        );
    }

    /**
     * Make the address instance.
     *
     * @param Address $address
     * @return AddressingAddress
     */
    protected static function makeAddress(Address $address): AddressingAddress
    { 
        return new AddressingAddress(
            $address->country,
            $address->state,
            $address->city,
            $address->district,
            $address->zip,
            $address->zip,
            "{$address->street}, {$address->number}",
            $address->complement
        );
    }
}