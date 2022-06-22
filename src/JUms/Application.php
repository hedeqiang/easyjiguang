<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JUms;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application.
 *
 * @property \EasyJiGuang\JUms\Client $ums
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ServiceProvider::class,
    ];
}
