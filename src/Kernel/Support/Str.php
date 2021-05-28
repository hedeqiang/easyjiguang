<?php

namespace EasyJiGuang\Kernel\Support;

class Str
{

    /**
     * The cache of studly-cased words.
     *
     * @var array
     */
    protected static $studlyCache = [];


    /**
     * Convert a value to studly caps case.
     *
     * @param  string  $value
     * @return string
     */
    public static function studly($value)
    {
        $key = $value;

        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }

        $value = ucwords(str_replace(['-', '_'], ' ', $value));

        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }

}
