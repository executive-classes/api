<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Environment Helpers
 */

if (!function_exists('isProduction')) {
    function isProduction(): bool {
        return App::environment('production');
    }
}

if (!function_exists('isLocal')) {
    function isLocal(): bool {
        return !isProduction();
    }
}

/**
 * Database dump helpers
 */

if (!function_exists('getDbDumpData')) {
    function getDbDumpData($prod = true): array {

        if ($prod) {
            $dbInfo = Config::get('database.connections.ec_prod', []);
            $today  = Carbon::now()->toDateString();
            $last_week = Carbon::now()->subWeeks(1)->toDateString();

            return [
                'username'      => $dbInfo['username'],
                'password'      => $dbInfo['password'],
                'database'      => $dbInfo['database'],
                'dump_folder'   => $dbInfo['dump_folder'],
                'dump_file'     => "dump-{$today}.sql",
                'remove_file'   => "dump-{$last_week}.sql",
                'dump_excluded' => implode(' ', preg_filter('/^/', '--ignore-table-data=', $dbInfo['dump_excluded'])),
            ];
        }

        $dbInfo = Config::get('database.connections.ec_dev', []);

        return [
            'username' => $dbInfo['username'],
            'password' => $dbInfo['password'],
            'database' => $dbInfo['database'],
        ];
}
}