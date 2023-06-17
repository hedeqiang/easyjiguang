<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JPush\Image;

use EasyJiGuang\Kernel\Exceptions\InvalidConfigException;
use EasyJiGuang\Kernel\Support\BaseClient;
use EasyJiGuang\Kernel\Support\Collection;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3/images';

    /**
     * 新增图片（URL方式）.
     *
     * @throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function createByUrls(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'byurls');

        return $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 新增图片（文件方式）.
     *
     *@throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function createByFiles(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'byfiles');

        return $this->httpUpload($url, $options, $this->getHeader(), ['image_type' => 2]);
    }

    /**
     * 更新图片（URL方式）.
     *
     *@throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function updateByUrls(string $mediaId, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "byurls/$mediaId");

        return $this->httpPut($url, $options, $this->getHeader());
    }

    /**
     * 更新图片（文件方式）.
     *
     *@throws GuzzleException
     * @throws InvalidConfigException
     *
     * @return array|Collection|object|ResponseInterface|string
     */
    public function updateByFiles(string $mediaId, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "byfiles/$mediaId");

        return $this->httpPut($url, $options, $this->getHeader());
    }
}
