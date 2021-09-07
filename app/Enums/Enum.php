<?php

namespace App\Enums;

use Illuminate\Support\Str;
use BenSampo\Enum\Enum as DefaultEnum;

abstract class Enum extends DefaultEnum
{
    public static function resource($resource)
    {
        $enum = self::fromValue($resource->id);

        $fields = __("enum.{$enum->getLangName()}.{$resource->id}");

        if (!is_array($fields)) {
            return $resource;
        }

        foreach ($fields as $field => $value) {
            $resource->$field = $value;
        }

        return $resource;
    }

    protected function getLangName(): string
    {
        $class = basename(str_replace('\\', '/', get_class($this)));
        return preg_replace('/_enum$/', '', Str::snake($class));
    }
}