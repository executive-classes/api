<?php

namespace App\Http\Resources\Billling;

use App\Http\Resources\Resource;
use App\Http\Resources\System\LanguageResource;
use App\Traits\Resources\WithPhones;
use App\Traits\Resources\WithTaxes;

class ProfileResource extends Resource
{
    use WithTaxes, WithPhones;

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
            'password_reminder' => $this->password_reminder,
            'email' => $this->email,
            'email_verified' => $this->email_verified_at !== null,
            'tax' => $this->makeTax($this->taxType, $this->tax_code),
            'tax_alt' => $this->makeTax($this->taxTypeAlt, $this->tax_code_alt),
            'phone' => $this->makePhone($this->phone),
            'phone_alt' => $this->makePhone($this->phone_alt),
            'language' => new LanguageResource($this->language)
        ];
    }
}
