<?php

namespace EasyJiGuang\JMLink;

use EasyJiGuang\Kernel\ServiceContainer;

/**
 * Class Application
 * @property \EasyJiGuang\JMLink\Client $link
 * @package EasyJiGuang\JMessage
 */
class Application extends ServiceContainer
{
    protected $providers = [
        ServiceProvider::class,
    ];

}