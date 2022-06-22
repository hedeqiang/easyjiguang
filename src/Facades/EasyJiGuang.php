<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\Facades;

use Illuminate\Support\Facades\Facade;

class EasyJiGuang extends Facade
{
    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return 'push';
    }

    /**
     * Return the facade accessor.
     */
    public static function JPush(): \EasyJiGuang\JPush\Application
    {
        return app('push');
    }

    public static function JVerify(): \EasyJiGuang\JVerify\Application
    {
        return app('verify');
    }

    public static function JMessage(): \EasyJiGuang\JMessage\Application
    {
        return app('message');
    }

    public static function JMLink(): \EasyJiGuang\JMLink\Application
    {
        return app('link');
    }

    public static function JUms(): \EasyJiGuang\JUms\Application
    {
        return app('ums');
    }
}
