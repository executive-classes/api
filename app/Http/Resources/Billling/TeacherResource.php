<?php

namespace App\Http\Resources\Billling;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'name' => $this->user->name,
            'email' => $this->user->email,
            'tax_type' => $this->user->tax_type_id,
            'tax_code' => $this->user->tax_code,
            'tax_type_alt' => $this->user->tax_type_alt_id,
            'tax_code_alt' => $this->user->tax_code_alt,
            'phone' => $this->user->phone,
            'phone_alt' => $this->user->phone_alt,
            'status' => $this->status->name,
            'status_id' => $this->teacher_status_id,
            'user_id' => $this->user_id
        ];
    }
}

