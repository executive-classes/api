<?php

namespace App\Http\Controllers\System;

use App\Filters\System\BugLogFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\GetBugLogRequest;
use App\Http\Resources\System\BugLogCollection;
use App\Models\System\SystemBuglog;

class BugLogController extends Controller
{
    public function index(GetBugLogRequest $request, BugLogFilter $filter)
    {
        $logs = SystemBuglog::filter($filter)
            ->limit($request->get('limit', 1000))
            ->paginate($request->get('paginate', 20));

        return new BugLogCollection($logs);
    }
}