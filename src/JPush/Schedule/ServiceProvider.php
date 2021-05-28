<?php

namespace EasyJiGuang\JPush\Schedule;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JPush\Schedule
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['schedule'] = function ($app) {
            return new Client($app);
        };
    }
}