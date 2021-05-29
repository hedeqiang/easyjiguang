<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Admin;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://admin.jpush.cn/v1/app';

    const ENDPOINT_VERSION = 'v1';

    /**
     * 创建极光 app.
     *
     * @param $options
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createApp($options)
    {
        return $this->httpPostJson(self::ENDPOINT_TEMPLATE, $options, $this->getHeader('dev'));
    }

    /**
     * app 删除.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteApp(string $appKey)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $appKey.'/delete');

        return $this->httpDelete(self::ENDPOINT_TEMPLATE.'/'.$url, $this->getHeader('dev'));
    }

    /**
     * 证书上传.
     *
     * @return array|\EasyJiGuang\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadCertificate(string $appKey, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $appKey.'/certificate');

        return $this->httpUpload($url, $options, $this->getHeader('dev'));
    }
}
