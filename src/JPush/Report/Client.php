<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Report;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://report.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    /**
     * 送达统计详情（新）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function received(array $query)
    {
        /*$query = [
            'msg_id' => $msg_id,
        ];*/
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'received/detail');

        return $this->httpGet($url, $query, $this->getHeader());
    }

    /**
     * 送达状态查询.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'status/message');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 消息统计详情（VIP 专属接口，新）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function detail(array $query)
    {
        /*$query = [
            'msg_ids' => $msg_ids,
        ];*/
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'messages/detail');

        return $this->httpGet($url, $query, $this->getHeader());
    }

    /**
     * 用户统计（VIP 专属接口）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function users(array $query)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'users');

        return $this->httpGet($url, $query, $this->getHeader());
    }

    /**
     * 分组统计-消息统计（VIP 专属接口）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function groupDetail(array $query)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'group/messages/detail');

        return $this->httpGet($url, $query, $this->getHeader('group'));
    }

    /**
     * 分组统计-用户统计（VIP 专属接口）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function groupUsers(array $query)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'group/users');

        return $this->httpGet($url, $query, $this->getHeader('group'));
    }
}
