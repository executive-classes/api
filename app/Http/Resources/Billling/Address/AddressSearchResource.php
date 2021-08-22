<?php

namespace App\Http\Resources\Billling\Address;

use App\Enums\Billing\CountryEnum;
use App\Http\Resources\Billling\AddressCountry\AddressCountryResource;
use App\Models\Billing\AddressCountry\AddressCountry;
use App\Services\Billing\Address\AddressFormatter;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressSearchResource extends JsonResource
{
    /**
     * The additional meta data that should be added to the resource response.
     *
     * Added during response construction by the developer.
     *
     * @var array
     */
    public $additional = [
        'status' => true
    ];

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'data';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => null,
            'zip' => $this->cep,
            'street' => $this->logradouro,
            'number' => null,
            'complement' => null,
            'district' => $this->bairro,
            'city' => $this->localidade,
            'state' => $this->uf,
            'country' => new AddressCountryResource(AddressCountry::where('short_name', CountryEnum::BR)->first()),
        ];
    }
}
