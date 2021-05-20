<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Billling\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
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
            'plainTextToken' => $this->plainTextToken,
            'user' => new UserResource($this->accessToken->tokenable),
            'accessToken' => new AccessTokenResource($this->accessToken),
        ];
    }
}
