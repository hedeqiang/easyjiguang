<?php

namespace Hedeqiang\JPush;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hedeqiang\JPush\Traits\HasHttpRequest;

class File extends Base
{
    use HasHttpRequest;

    const ENDPOINT_TEMPLATE = 'https://api.jpush.cn/v3/files';

    const ENDPOINT_VERSION = 'v3';


    /**
     * 上传文件
     * @param string $type
     * @param $content
     * @return array
     */
    public function files(string $type,$content)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$type);
        try {
            return $this->post($url, $content, $this->getHeader());
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
            return $this->get(self::ENDPOINT_TEMPLATE , [], $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$file_id);
        try {
            return $this->delete($url, $this->getHeader());
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
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$file_id);
        try {
            return $this->get($url, [], $this->getHeader());
        } catch (GuzzleException $e) {
            return $e->getResponse()->getBody()->getContents();
        }
    }


}