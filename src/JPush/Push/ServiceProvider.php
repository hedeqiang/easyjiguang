<?php

namespace EasyJiGuang\JPush\Push;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JPush\Push
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['push'] = function ($app) {
            return new Client($app);
        };
    }
}