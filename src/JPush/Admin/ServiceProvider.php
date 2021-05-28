<?php

namespace EasyJiGuang\JPush\Admin;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JPush\Admin
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['admin'] = function ($app) {
            return new Client($app);
        };
    }
}