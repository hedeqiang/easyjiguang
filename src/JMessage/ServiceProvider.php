<?php

namespace EasyJiGuang\JMessage;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JMessage
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['message'] = function ($app) {
            return new Client($app);
        };
    }
}