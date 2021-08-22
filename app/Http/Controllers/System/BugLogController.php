<?php

namespace App\Http\Controllers\System;

use App\Models\System\SystemBugLog\SystemBugLogFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\GetBugLogRequest;
use App\Http\Resources\System\BugLogCollection;
use App\Models\System\SystemBugLog\SystemBugLog;

class BugLogController extends Controller
{
    public function index(GetBugLogRequest $request, SystemBugLogFilters $filter)
    {
        $logs = SystemBugLog::filter($filter)
            ->limit($request->get('limit', 1000))
            ->get();

        return new BugLogCollection($logs);
    }
}