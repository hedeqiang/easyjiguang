<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class File
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3/files';

    const ENDPOINT_VERSION = 'v3';

    protected $config;


    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 上传文件
     * @param string $type
     * @param array $multipart
     * @return array
     */
    public function files(string $type,array $multipart)
    {
        /* $multipart = [
            'name'     => 'file_name',
            'contents' => fopen('/path/to/file', 'r')
        ],*/
        try {
            $response = $this->post(self::ENDPOINT_TEMPLATE . '/' . $type,
                [],$multipart, $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 查询有效文件列表
     * @return array
     */
    public function getFiles()
    {
        try {
            $response = $this->get(self::ENDPOINT_TEMPLATE ,
                [], $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 删除文件
     * @param string $file_id
     * @return array
     */
    public function deleteFiles(string $file_id)
    {
        try {
            $response = $this->delete(self::ENDPOINT_TEMPLATE .'/' . $file_id,
                [], $this->getHeader());
            return $response;
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }

    /**
     * 查询指定文件详情
     * @param string $file_id
     * @return array
     */
    public function getFilesById(string $file_id)
    {
        try {
            $response = $this->get(self::ENDPOINT_TEMPLATE .'/' . $file_id,
                [], $this->getHeader());
            return $response;
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