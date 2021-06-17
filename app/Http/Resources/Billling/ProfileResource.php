<?php

namespace App\Http\Resources\Billling;

use App\Http\Resources\System\LanguageResource;
use App\Services\Billing\Phone\BrazillianPhone;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified' => $this->email_verified_at !== null,
            'tax_type' => new TaxTypeResource($this->taxType),
            'tax_code' => $this->taxType->mask($this->tax_code),
            'tax_type_alt' => new TaxTypeResource($this->taxTypeAlt),
            'tax_code_alt' => $this->taxTypeAlt ? $this->taxTypeAlt->mask($this->tax_code_alt) : null,
            'phone' => $this->phone ? BrazillianPhone::format($this->phone) : null,
            'phone_alt' => $this->phone ? BrazillianPhone::format($this->phone_alt) : null,
            'language' => new LanguageResource($this->language)
        ];
    }
}
