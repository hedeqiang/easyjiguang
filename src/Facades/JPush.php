<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hedeqiang\JPush\Facades;

use Illuminate\Support\Facades\Facade;

class JPush extends Facade
{
    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'jpush.push';
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\JPush\JPush
     */
    public static function push()
    {
        return app('jpush.push');
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\JPush\File
     */
    public static function file()
    {
        return app('jpush.file');
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\JPush\Device
     */
    public static function device()
    {
        return app('jpush.device');
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\JPush\Report
     */
    public static function report()
    {
        return app('jpush.report');
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\JPush\Schedule
     */
    public static function schedule()
    {
        return app('jpush.schedule');
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\JPush\Admin
     */
    public static function admin()
    {
        return app('jpush.admin');
    }
}
