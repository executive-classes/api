<?php

namespace App\Http\Resources\Auth;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AccessTokenResource extends JsonResource
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
            "name" => $this->name,
            "abilities" => $this->abilities,
            "tokenable_id" => $this->tokenable_id,
            "tokenable_type" => $this->tokenable_type,
            "updated_at" => Carbon::parse($this->updated_at)->toDateTimeString(),
            "created_at" => Carbon::parse($this->created_at)->toDateTimeString(),
            "expires_at" => Carbon::parse($this->created_at)->addMinutes(config('sanctum.expiration'))->toDateTimeString(),
            "id" => $this->id
        ];
    }
}
