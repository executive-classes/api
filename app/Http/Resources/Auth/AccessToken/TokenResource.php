<?php

namespace App\Http\Resources\Auth\AccessToken;

use App\Http\Resources\Resource;
use App\Http\Resources\Billing\User\UserResource;

class TokenResource extends Resource
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
            'plainTextToken' => $this->plainTextToken,
            'user' => new UserResource($this->accessToken->tokenable),
            'accessToken' => new AccessTokenResource($this->accessToken),
        ];
    }
}
