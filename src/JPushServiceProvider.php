<?php

/*
 * This file is part of the hedeqiang/jpush.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang;

use EasyJiGuang\JPush\Application as JPush;
use EasyJiGuang\JVerify\Application as JVerify;

class JPushServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/jpush.php' => config_path('jpush.php'),
        ], 'jpush');
    }

    public function register()
    {
        $apps = [
            'JVerify' => JVerify::class,
            'JPush' => JPush::class,
        ];

        $this->app->alias(JPush::class, 'push');
        $this->app->alias(JVerify::class, 'verify');
    }
}
