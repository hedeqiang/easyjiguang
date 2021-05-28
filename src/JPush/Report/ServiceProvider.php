<?php

namespace EasyJiGuang\JPush\Report;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JPush\Report
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['report'] = function ($app) {
            return new Client($app);
        };
    }
}