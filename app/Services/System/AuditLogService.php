<?php

namespace App\Services\System;

use App\Enums\System\AuditLogTypeEnum;
use App\Models\System\SystemAuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AuditLogService
{
    private static function audit(
        Request $request, 
        Model $model, 
        AuditLogTypeEnum $typeEnum, 
        array $before = [], 
        array $after = [], 
        array $relations = []
    ): SystemAuditLog {
        $user = $request->user();
        $route = $request->route();
        $log = new SystemAuditLog();

        $log->user_id = $user ? $user->id : null;
        $log->cross_user_id = $user ? $user->crossId() : null;
        $log->relations = json_encode($relations);
        $log->agent = $request->userAgent();
        $log->method = $request->method();
        $log->url = $request->fullUrl();
        $log->route = $route ? $route->getName() : $request->getRequestUri();
        $log->ajax = $request->ajax();
        $log->type = $typeEnum->value;
        $log->table = $model->getTable();
        $log->before = json_encode($before);
        $log->after = json_encode($after);

        $log->save();

        return $log;
    }

    public static function insert(Request $request, Model $model, array $relations = []): SystemAuditLog
    {
        return self::audit(
            $request, 
            $model, 
            AuditLogTypeEnum::INSERT(), 
            [], 
            $model->getAttributes(), 
            $relations
        );
    }

    public static function update(Request $request, Model $model, array $relations = []): SystemAuditLog
    {
        return self::audit(
            $request, 
            $model, 
            AuditLogTypeEnum::UPDATE(), 
            array_intersect_key($model->getRawOriginal(), $model->getChanges()), 
            $model->getChanges(), 
            $relations
        );
    }

    public static function delete(Request $request, Model $model, array $relations = []): SystemAuditLog
    {
        return self::audit(
            $request, 
            $model, 
            AuditLogTypeEnum::DELETE(), 
            $model->getAttributes(), 
            [], 
            $relations
        );
    }

}