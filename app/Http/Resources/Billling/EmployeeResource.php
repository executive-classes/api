<?php

namespace App\Http\Resources\Billling;

use App\Http\Resources\Billling\EmployeePosition\EmployeePositionResource;
use App\Http\Resources\Billling\EmployeeStatus\EmployeeStatusResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'created_at' => Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => Carbon::parse($this->updated_at)->toDateTimeString(),
            'user' => new UserResource($this->user),
            'status' => new EmployeeStatusResource($this->status),
            'position' => new EmployeePositionResource($this->position),
        ];
    }
}

