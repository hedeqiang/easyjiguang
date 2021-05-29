<?php

namespace EasyJiGuang\JMessage;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application
 * @property \EasyJiGuang\JMessage\Client $message
 * @package EasyJiGuang\JMessage
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ServiceProvider::class,
    ];

}