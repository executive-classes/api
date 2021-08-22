<?php

namespace App\Http\Resources\System\SystemBugLog;

use App\Http\Resources\Resource;
use App\Http\Resources\Billling\User\UserResource;

class SystemBugLogResource extends Resource
{
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
