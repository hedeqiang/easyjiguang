<?php

/*
 * This file is part of the hedeqiang/jpush.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JMLink;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.jmlk.co/v1/';

    const ENDPOINT_VERSION = 'v1';

    /**
     * 短链查询.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'links');

        $this->httpGet($url, $options, $this->getHeader());
    }

    /**
     * 短链统计
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function count(string $link_key, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "links/$link_key/stat");

        $this->httpGet($url, $options, $this->getHeader());
    }
}
