<?php

namespace App\Services\System;

use App\Enums\System\SystemAppEnum;
use App\Models\System\SystemBuglog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class BugLogService
{
    public static function log(Request $request, Throwable $th)
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
            $bug->data = json_encode(self::getData($request));
            $bug->error = json_encode(self::getError($th));
    
            $bug->save();
    
            return $bug;
        } catch (\Throwable $th) {
            return;
        }
    }

    private static function getData(Request $request): array
    {
        return array_replace_recursive(
            $request->route() 
                ? $request->route()->parameters() 
                : [],
            $request->all()
        );
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