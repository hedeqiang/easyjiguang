<?php

namespace EasyJiGuang\JPush;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application
 * @property \EasyJiGuang\JPush\Push\Client $push
 * @property \EasyJiGuang\JPush\File\Client $file
 * @property \EasyJiGuang\JPush\Device\Client $device
 * @property \EasyJiGuang\JPush\Admin\Client $admin
 * @property \EasyJiGuang\JPush\Report\Client $report
 * @property \EasyJiGuang\JPush\Schedule\Client $schedule
 * @property \EasyJiGuang\JPush\Image\Client $image
 * @package EasyJiGuang\JPush
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