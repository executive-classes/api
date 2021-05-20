<?php

namespace App\Services\System;

use App\Enums\System\SystemAppEnum;
use App\Models\System\SystemBuglog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class BugLogService
{
    public static function log(Request $request, Throwable $th, array $except = [])
    {
        try {
            $user = $request->user();
            $bug = new SystemBuglog();

            $bug->user_id = $user ? $user->id : null;;
            $bug->cross_user_id = $user ? $user->crossId() : null;;
            $bug->agent = $request->userAgent();
            $bug->url = $request->fullUrl();
            $bug->method = $request->method();
            $bug->ajax = $request->ajax();
            $bug->app_id = SystemAppEnum::API;
            $bug->route = $request->getRequestUri();
            $bug->data = json_encode(self::getData($request, $except));
            $bug->error = json_encode(self::getError($th));

            $bug->save();

            return $bug;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return;
        }
    }

    private static function getData(Request $request, array $except): array
    {
        return array_filter(array_replace_recursive(
            $request->route()
                ? $request->route()->parameters()
                : [],
            $request->all()
        ), function ($key) use ($except) {
            return !in_array($key, $except);
        }, ARRAY_FILTER_USE_KEY);
    }

    private static function getError(Throwable $th): array
    {
        return [
            'message' => $th->getMessage(),
            'code' => $th->getCode(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'stack' => $th->getTrace()
        ];
    }
}
