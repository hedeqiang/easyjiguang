<?php

namespace EasyJiGuang\JMLink;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JMLink
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['link'] = function ($app) {
            return new Client($app);
        };
    }
}