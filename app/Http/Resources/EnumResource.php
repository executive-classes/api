<?php

namespace App\Http\Resources;

class EnumResource extends Resource
{
    /**
     * The Enum class.
     * 
     * @var \App\Enums\Enum
     */
    public $enum = null;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {
        if ($this->enum) {
            $resource = $this->enum::resource($resource);
        }

        parent::__construct($resource);
    }
}