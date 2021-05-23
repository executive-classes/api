<?php

namespace App\Http\Resources\System;

use App\Http\Resources\Billling\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BugLogResource extends JsonResource
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
        $error = json_decode($this->error);

        return [
            'id' => $this->id,
            'date' => $this->date,
            'user' => new UserResource($this->user),
            'cross_user' => new UserResource($this->cross_user),
            'agent' => $this->agent,
            'url' => $this->url,
            'route' => $this->route,
            'method' => $this->method,
            'ajax' => $this->ajax,
            'app' => $this->app->name,
            'error' => $error,
            'message' => $error->message,
            'data' => json_decode($this->data)
        ];
    }
}
