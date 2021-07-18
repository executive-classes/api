<?php

namespace App\Http\Resources\Billling\AddressState;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressStatesResource extends JsonResource
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
            'abbr' => Str::lower($this->short_name),
            'short_name' => $this->short_name,
            'name' => $this->name,
            'ie_mask' => $this->ie_mask
        ];
    }
}
