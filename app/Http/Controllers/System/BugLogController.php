<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\GetBugLogRequest;
use App\Models\System\SystemBugLog\SystemBugLog;
use App\Models\System\SystemBugLog\SystemBugLogFilters;
use App\Http\Resources\System\SystemBugLog\SystemBugLogCollection;

class BugLogController extends Controller
{
    public function index(GetBugLogRequest $request, SystemBugLogFilters $filter)
    {
        $logs = SystemBugLog::filter($filter)
            ->limit($request->get('limit', 1000))
            ->get();

        return new SystemBugLogCollection($logs);
    }
}