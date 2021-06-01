<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\Providers;

use EasyJiGuang\JPush\Application as JPush;
use EasyJiGuang\JVerify\Application as JVerify;
use EasyJiGuang\JVerify\Application as JMessage;
use EasyJiGuang\JMLink\Application as JMLink;

class JiGuangServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Config/jiguang.php' => config_path('jiguang.php'),
        ], 'jiguang');
    }

    public function register()
    {
        $apps = [
            'verify' => JVerify::class,
            'push' => JPush::class,
            'message' => JMessage::class,
            'link' => JMLink::class,
        ];
        foreach ($apps as $name => $class) {
            $this->app->singleton($class, function () use ($class) {
                return new $class(config('jiguang'));
            });
            $this->app->alias($class, $name);
        }
    }
}
