<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \EasyJiGuang\JPush\Push\Client     $push
 * @property \EasyJiGuang\JPush\File\Client     $file
 * @property \EasyJiGuang\JPush\Device\Client   $device
 * @property \EasyJiGuang\JPush\Admin\Client    $admin
 * @property \EasyJiGuang\JPush\Report\Client   $report
 * @property \EasyJiGuang\JPush\Schedule\Client $schedule
 * @property \EasyJiGuang\JPush\Image\Client    $image
 */
class Application extends ServiceContainer
{
    protected $providers = [
        Push\ServiceProvider::class,
        File\ServiceProvider::class,
        Device\ServiceProvider::class,
        Admin\ServiceProvider::class,
        Report\ServiceProvider::class,
        Schedule\ServiceProvider::class,
        Image\ServiceProvider::class,
    ];
}
