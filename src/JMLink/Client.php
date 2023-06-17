<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JMLink;

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\Support\BaseClient;
use GuzzleHttp\Exception\GuzzleException;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.jmlk.co/v1/';


    /**
     * 短链查询.
     *
     * @param array $options
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function get(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'links');

        $this->httpGet($url, $options, $this->getHeader());
    }

    /**
     * 短链统计
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     */
    public function count(string $link_key, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "links/$link_key/stat");

        $this->httpGet($url, $options, $this->getHeader());
    }
}
