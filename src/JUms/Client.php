<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JUms;

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.ums.jiguang.cn/v1/%s';

    /**
     * @throws InvalidConfigException
     */
    public function broadcast(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'broadcast');

        return $this->httpPostJson($url, $options, $this->getHeader('ums'));
    }

    public function sent(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'sent');

        return $this->httpPostJson($url, $options, $this->getHeader('ums'));
    }

    public function templateBroadcast(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'template/broadcast');

        return $this->httpPostJson($url, $options, $this->getHeader('ums'));
    }

    public function templateSent(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'template/sent');

        return $this->httpPostJson($url, $options, $this->getHeader('ums'));
    }
}
