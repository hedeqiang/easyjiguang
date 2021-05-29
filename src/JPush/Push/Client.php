<?php

/*
 * This file is part of the hedeqiang/jpush.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Push;

use EasyJiGuang\Kernel\Support\BaseClient;
use GuzzleHttp\Exception\GuzzleException;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    /**
     * 向某单个设备或者某设备列表推送一条通知、或者消息。
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     */
    public function message(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 推送唯一标识符.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCid(array $query)
    {
        /*$query = [
            'count' => $count,
            'type'  => $type,
        ];*/
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/cid');

        return $this->httpGet($url, $query, $this->getHeader());
    }

    /**
     * 推送校验 API.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/validate');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 批量单推  针对的是RegID方式批量单推.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws GuzzleException
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     */
    public function batchRegidSingle(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/batch/regid/single');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 针对的是Alias方式批量单推.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchAliasSingle(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/batch/alias/single');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 推送撤销
     *
     * @param $msgid
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function revoke($msgid)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/'.$msgid);

        return $this->httpDelete($url, $this->getHeader());
    }

    /**
     * 文件推送
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function file(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/file');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * Group Push API：应用分组推送
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function groupPush(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'grouppush');

        return $this->httpPostJson($url, $options, $this->getHeader('group'));
    }

    /**
     * 应用分组文件推送（VIP专属接口）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function groupPushFile(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'grouppush/file');

        return $this->httpPostJson($url, $options, $this->getHeader('group'));
    }
}
