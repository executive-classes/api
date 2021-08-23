<?php

namespace App\Http\Requests\System;

use App\Http\Requests\Request;

class GetBugLogRequest extends Request
{
    /**
     * Get the request rules.
     *
     * @return array
     */
    public function getRules(): array
    {
        return [
            'limit' => 'sometimes|numeric|max:1000',
            'paginate' => 'sometimes|numeric|min:5|max:100'
        ];
    }
}