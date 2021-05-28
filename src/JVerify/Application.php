<?php

namespace EasyJiGuang\JVerify;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application
 * @property \EasyJiGuang\JVerify\Client $verify
 * @package EasyJiGuang\JPush
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ServiceProvider::class,
    ];

}