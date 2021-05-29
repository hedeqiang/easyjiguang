<?php

/*
 * This file is part of the hedeqiang/jpush.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JMessage;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \EasyJiGuang\JMessage\Client $message
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ServiceProvider::class,
    ];
}
