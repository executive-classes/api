<?php

namespace App\Http\Resources\Billling;

use App\Http\Resources\System\LanguageResource;
use App\Services\Billing\Phone\BrazillianPhone;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            'inactive_at' => $this->inactive_at ? Carbon::parse($this->inactive_at)->toDateTimeString() : null,
            'reactive_at' => $this->reactive_at ? Carbon::parse($this->reactive_at)->toDateTimeString() : null,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified' => $this->email_verified_at !== null,
            'status' => $this->active ? 'Ativo' : 'Suspenso',
            'active' => $this->active,
            'tax_type' => new TaxTypeResource($this->taxType),
            'tax_code' => $this->taxType->mask($this->tax_code),
            'tax_type_alt' => new TaxTypeResource($this->taxTypeAlt),
            'tax_code_alt' => $this->taxTypeAlt ? $this->taxTypeAlt->mask($this->tax_code_alt) : null,
            'phone' => $this->phone ? BrazillianPhone::format($this->phone) : null,
            'phone_alt' => $this->phone_alt ? BrazillianPhone::format($this->phone_alt) : null,
            'language' => new LanguageResource($this->language)

        ];
    }
}
