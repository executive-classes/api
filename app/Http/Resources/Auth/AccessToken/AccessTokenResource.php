<?php

namespace App\Http\Resources\Auth\AccessToken;

use Carbon\Carbon;
use App\Http\Resources\Resource;

class AccessTokenResource extends Resource
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
