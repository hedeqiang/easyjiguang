<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Device;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://device.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    protected $config;

    /***
     * 查询设备的别名与标签.
     * @param $registration_id
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDevices($registration_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'devices/'.$registration_id);

        return $this->httpGet($url, [], $this->getHeader());
    }

    /**
     * 设置设备的别名与标签.
     *
     * @param $registration_id
     * @param $options
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateDevices($registration_id, $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'devices/'.$registration_id);

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 查询别名.
     *
     * @param $alias_value
     * @param string[] $platform
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAliases($alias_value, $platform = ['platform ' => 'all'])
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'aliases/'.$alias_value);

        return $this->httpGet($url, $platform, $this->getHeader());
    }

    /**
     * 删除别名.
     *
     * @param $alias_value
     * @param string[] $platform
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteAliases($alias_value, $platform = ['platform ' => 'all'])
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'aliases/'.$alias_value);

        return $this->httpDelete($url, $this->getHeader(), $platform);
    }

    /**
     * 解绑设备与别名的绑定关系.
     *
     * @param $alias_value
     * @param $options
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeAliases($alias_value, $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'aliases/'.$alias_value);

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 查询标签列表.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTags()
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'tags');

        return $this->httpGet($url, [], $this->getHeader());
    }

    /**
     * 判断设备与标签绑定关系.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function isDeviceInTag(string $tag_value, string $registration_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'tags/'.$tag_value.'/registration_ids/'.$registration_id);

        return $this->httpGet($url, [], $this->getHeader());
    }

    /**
     * 更新标签.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateTag(string $tag_value, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'tags'.$tag_value);

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     *  删除标签.
     *
     * @param string[] $platform
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTag(string $tag_value, $platform = ['platform ' => 'all'])
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'tags'.$tag_value);

        return $this->httpDelete($url, $this->getHeader(), $platform);
    }

    /**
     * 获取用户在线状态（VIP 专属接口）.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function status(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'devices/status/');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }
}
