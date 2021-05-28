<?php

namespace EasyJiGuang;



/**
 * @method static \EasyJiGuang\JPush\Application JPush(array $config)
 * @method static \EasyJiGuang\JVerify\Application JVerify(array $config)
 * Class Factory
 * @package EasyJiGuang
 */
class Factory
{
    /**
     * @param $name
     * @param array $config
     * @return mixed
     */
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\EasyJiGuang\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $name, array $arguments)
    {
        return self::make($name, ...$arguments);
    }
}