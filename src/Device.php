<?php

namespace Hedeqiang\JPush;

use Hedeqiang\JPush\Exceptions\HttpException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Device extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://device.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    protected $config;


    /**
     * 查询设备的别名与标签
     * @param $registration_id
     * @return array
     * @throws HttpException
     */
    public function getDevices($registration_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'devices/'. $registration_id);
        try {
            return $this->get($url ,[], $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 设置设备的别名与标签
     * @param $registration_id
     * @param $options
     * @return array
     * @throws HttpException
     */
    public function updateDevices($registration_id,$options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'devices/'. $registration_id);
        try {
            return $this->postJson( $url ,$options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 查询别名
     * @param $alias_value
     * @param string[] $platform
     * @return array
     * @throws HttpException
     */
    public function getAliases($alias_value, $platform = ['platform ' => 'all'])
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'aliases/'. $alias_value);
        try {
            return $this->get($url ,$platform, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 删除别名
     * @param $alias_value
     * @param string[] $platform
     * @return array
     * @throws HttpException
     */
    public function deleteAliases($alias_value, $platform = ['platform ' => 'all'])
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'aliases/'. $alias_value);
        try {
            return $this->delete($url, $this->getHeader(),$platform);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 解绑设备与别名的绑定关系
     * @param $alias_value
     * @param $options
     * @return array
     * @throws HttpException
     */
    public function removeAliases($alias_value, $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'aliases/'. $alias_value);
        try {
            return $this->postJson($url,$options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 查询标签列表
     * @return array
     * @throws HttpException
     */
    public function getTags()
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'tags');
        try {
            return $this->get($url,[], $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 判断设备与标签绑定关系
     * @param string $tag_value
     * @param string $registration_id
     * @return array
     * @throws HttpException
     */
    public function isDeviceInTag(string $tag_value,string $registration_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'tags/' . $tag_value .'/registration_ids/' . $registration_id);
        try {
            return $this->get($url, [], $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 更新标签
     * @param string $tag_value
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function updateTag(string $tag_value,array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'tags'. $tag_value);
        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 删除标签
     * @param string $tag_value
     * @param string[] $platform
     * @return array
     * @throws HttpException
     */
    public function deleteTag(string $tag_value,$platform = ['platform ' => 'all'])
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'tags'. $tag_value);
        try {
            return $this->delete($url, $this->getHeader(),$platform);
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 获取用户在线状态（VIP 专属接口）
     * @param array $options
     * @return array
     * @throws HttpException
     */
    public function status(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,'devices/status/');
        try {
            return $this->postJson($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }


}