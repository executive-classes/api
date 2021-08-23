<?php

namespace App\Models\Eloquent\System\SystemBugLog;

use App\Support\QueryFilter\QueryFilter;

class SystemBugLogFilters extends QueryFilter
{
    public function date($query, $value)
    {
        return $query->where('date', '>=', $value);
    }

    public function user($query, $value)
    {
        return $query->where('user_id', $value)->whereOr('cross_user_id', $value);
    }

    public function app($query, $value)
    {
        return $query->where('app_id', $value);
    }

    public function ajax($query)
    {
        return $query->where('ajax', true);
    }
}
