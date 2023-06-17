<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Push;

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\Support\BaseClient;
use EasyJiGuang\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3';

    /**
     * 向某单个设备或者某设备列表推送一条通知、或者消息。
     *
     * @param array $options
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function message(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 推送唯一标识符.
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
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
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function validate(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/validate');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 批量单推  针对的是RegID方式批量单推.
     *
     * @throws InvalidConfigException
     * @throws GuzzleException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function batchRegidSingle(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/batch/regid/single');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 针对的是Alias方式批量单推.
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function batchAliasSingle(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/batch/alias/single');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 推送撤销
     *
     * @param $msgID
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function revoke($msgID)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/'.$msgID);

        return $this->httpDelete($url, $this->getHeader());
    }

    /**
     * 文件推送
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function file(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'push/file');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * Group Push API：应用分组推送
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function groupPush(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'grouppush');

        return $this->httpPostJson($url, $options, $this->getHeader('group'));
    }

    /**
     * 应用分组文件推送（VIP专属接口）.
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function groupPushFile(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'grouppush/file');

        return $this->httpPostJson($url, $options, $this->getHeader('group'));
    }
}
