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

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\Support\BaseClient;
use EasyJiGuang\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://admin.jpush.cn/v1/app';

    /**
     * 创建极光 app.
     *
     * @param $options
     *
     *@throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function createApp($options)
    {
        return $this->httpPostJson(self::ENDPOINT_TEMPLATE, $options, $this->getHeader('dev'));
    }

    /**
     * app 删除.
     *
     *@throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function deleteApp(string $appKey)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $appKey.'/delete');

        return $this->httpDelete(self::ENDPOINT_TEMPLATE.'/'.$url, $this->getHeader('dev'));
    }

    /**
     * 证书上传.
     *
     *@throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function uploadCertificate(string $appKey, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, $appKey.'/certificate');

        return $this->httpUpload($url, $options, $this->getHeader('dev'));
    }
}
