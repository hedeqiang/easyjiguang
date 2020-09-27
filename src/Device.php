<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class Device
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://device.jpush.cn/v3';

    const ENDPOINT_VERSION = 'v3';

    protected $config;


    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 查询设备的别名与标签
     * @param $registration_id
     * @return array
     */
    public function getDevices($registration_id)
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE .'/devices/'. $registration_id,[], $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 设置设备的别名与标签
     * @param $registration_id
     * @param $options
     * @return array
     */
    public function setDevices($registration_id,$options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE .'/devices/'. $registration_id,$options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 查询别名
     * @param $alias_value
     * @param string[] $platform
     * @return array
     */
    public function getAliases($alias_value, $platform = ['platform ' => 'all'])
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE .'/aliases/'. $alias_value,$platform, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 删除别名
     * @param $alias_value
     * @param string[] $platform
     * @return array
     */
    public function deleteAliases($alias_value, $platform = 'all')
    {
        try {
            return $this->delete(self::ENDPOINT_TEMPLATE .'/aliases/'. $alias_value, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 解绑设备与别名的绑定关系
     * @param $alias_value
     * @param $options
     * @return array
     */
    public function removeAliases($alias_value, $options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE .'/aliases/'. $alias_value,$options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 查询标签列表
     * @return array
     */
    public function getTags()
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE .'/tags',[], $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 判断设备与标签绑定关系
     * @param string $tag_value
     * @param string $registration_id
     * @return array
     */
    public function isDeviceInTag(string $tag_value,string $registration_id)
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE .'/tags/' . $tag_value .'/registration_ids/' . $registration_id,
                [], $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 更新标签
     * @param string $tag_value
     * @param array $options
     * @return array
     */
    public function updateTag(string $tag_value,array $options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE .'/tags/' .$tag_value,
                $options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 删除标签
     * @param string $tag_value
     * @param string[] $platform
     * @return array
     */
    public function deleteTag(string $tag_value,$platform = ['platform ' => 'all'])
    {
        try {
            return $this->delete(self::ENDPOINT_TEMPLATE .'/tags/' .$tag_value,
                 $this->getHeader(),$platform);
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 获取用户在线状态（VIP 专属接口）
     * @param array $options
     * @return array
     */
    public function status(array $options)
    {
        try {
            return $this->postJson(self::ENDPOINT_TEMPLATE .'/devices/status/',
                $options, $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }




    /**
     * @param string $type
     * @return string
     */
    protected function getAuthStr(string $type): string
    {
        if ($type === 'app')
            return base64_encode($this->config->get('appKey') .':'. $this->config->get('masterSecret'));
        else{
            // group
            return base64_encode($this->config->get('groupKey') .':'. $this->config->get('group_secret'));
        }
    }


    /**
     * 获取 Header
     * @param string $type
     * @return string[]
     */
    protected function getHeader($type = 'app'): array
    {
        return [
            'Authorization' => 'Basic ' . $this->getAuthStr($type)
        ];
    }

}