<?php

namespace App\Http\Resources\Billling\AddressCountry;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressCountryResource extends JsonResource
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
            'short_name' => $this->short_name,
            'name' => $this->name,
            'name_pt' => $this->name_pt
        ];
    }
}
