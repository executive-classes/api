<?php

namespace App\Http\Resources\Billing\AddressState;

use App\Http\Resources\Resource;
use Illuminate\Support\Str;

class AddressStatesResource extends Resource
{
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
            'abbr' => Str::lower($this->short_name),
            'short_name' => $this->short_name,
            'name' => $this->name,
            'ie_mask' => $this->ie_mask
        ];
    }
}
