<?php

namespace EasyJiGuang\JPush\Image;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package EasyJiGuang\JPush\Image
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}.
     */
    public function register(Container $pimple)
    {
        $pimple['image'] = function ($app) {
            return new Client($app);
        };
    }
}