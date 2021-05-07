<?php

use App\Enums\Billing\UserPrivilegeEnum;
use App\Http\Response\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Monolog\Handler\GelfHandler;

/**
 * HTTP contants
 */
const HTTP_INFORMATION = 100;
const HTTP_SUCCESS = 200;
const HTTP_REDIRECT = 300;
const HTTP_CLIENT_ERROR = 400;
const HTTP_SERVER_ERROR = 500;

/**
 * Environment Helpers
 */

if (!function_exists('isProduction')) {
    function isProduction(): bool {
        return env('APP_ENV') === 'production';
    }
}

if (!function_exists('isLocal')) {
    function isLocal(): bool {
        return !isProduction();
    }
}

if (!function_exists('timezone')) {
    function timezone(): string {
        return config('app.timezone');
    }
}

/**
 * Facades helpers
 */

if (!function_exists('api')) {
    function api(): Api {
        return new Api;
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

/**
 * Http Helpers
 */

if (!function_exists('isHttpCode')) {
    function isHttpCode(int $code, ...$scopes): bool {
        if (empty($scopes)) {
            $scopes = [
                HTTP_INFORMATION, 
                HTTP_SUCCESS, 
                HTTP_REDIRECT, 
                HTTP_CLIENT_ERROR, 
                HTTP_SERVER_ERROR
            ];
        }
        
        foreach ($scopes as $scope) {
            if ($code >= $scope || $code < $scope + 100) {
                return true;
            }
        }

        return false;
    }
}

/**
 * View Helpers
 */

if (!function_exists('render')) {
    /**
     * Render a string with blade code.
     * @source https://laracasts.com/discuss/channels/general-discussion/render-template-from-blade-template-in-database
     */
    function render(string $__php, array $__data)
    {
        $obLevel = ob_get_level();
        ob_start();
        extract($__data, EXTR_SKIP);
        try {
            eval('?' . '>' . $__php);
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        }
        return ob_get_clean();
    }
}

/**
 * Formatting helpers
 */

if (!function_exists('format_mask')) {
    function format_mask(string $mask, string $string): string {
        $string = str_replace(" ", "", $string);

        for ($i=0; $i < strlen($string); $i++) { 
            $test = $string[$i];
            $test = $mask[strpos($mask,"#")];
            $mask[strpos($mask,"#")] = $string[$i];
        }

        return $mask;
    }
}

if (!function_exists('format_zip')) {
    function format_zip($zip): string {
        return format_mask('#####-###', $zip);
    }
}

if (!function_exists('format_date')) {
    function format_date(string $dateTime = null, string $format = 'Y-m-d H:i:s'): string {
        if ($dateTime) {
            return Carbon::parse($dateTime)->format($format);
        }

        return Carbon::now()->format($format);
    }
}

/**
 * Date and time helpers
 */

if (!function_exists('getYear')) {
    function getYear(string $dateTime = null, string $format = 'Y'): string {
        return format_date($dateTime, $format);
    }
}

if (!function_exists('getMonth')) {
    function getMonth(string $dateTime = null, string $format = 'm'): string {
        return format_date($dateTime, $format);
    }
}

/**
 * String Helpers
 */

if (!function_exists('underlineToCamelCase')) {
    function underlineToCamelCase(string $string, bool $capitalizeFirstCharacter = true): string {
        $result = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (!$capitalizeFirstCharacter) {
            $result[0] = strtolower($result[0]);
        }

        return $result;
    }
}

if (!function_exists('removeByRegex')) {
    function removeByRegex(string $regex, string $string): string {
        return preg_replace($regex, '', $string);
    }
}

if (!function_exists('removeNonDigit')) {
    function removeNonDigit(string $string): string {
        return removeByRegex('/\D/', $string);
    }
}