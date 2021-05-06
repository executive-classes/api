<?php

namespace App\Http\Resources\Billling;

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
            'active' => $this->active,
            'tax_type' => $this->tax_type_id,
            'tax_code' => $this->tax_code,
            'tax_type_alt' => $this->tax_type_alt_id,
            'tax_code_alt' => $this->tax_code_alt,
            'phone' => $this->phone,
            'phone_alt' => $this->phone_alt,
            'language' => $this->system_language_id
        ];
    }
}
