<?php

namespace Hedeqiang\JPush;

use Hedeqiang\JPush\Exceptions\HttpException;
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
     * @throws HttpException
     */
    public function files(string $type,$content)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$type);
        try {
            $options = [
                [
                    'Content-type' => 'multipart/form-data',
                    'name' => 'filename',
                    'contents' => $content
                ]
            ];
            return $this->post($url, $options, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 查询有效文件列表
     * @return array
     * @throws HttpException
     */
    public function getFiles()
    {
        try {
            return $this->get(self::ENDPOINT_TEMPLATE , [], $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 删除文件
     * @param string $file_id
     * @return array
     * @throws HttpException
     */
    public function deleteFiles(string $file_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$file_id);
        try {
            return $this->delete($url, $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * 查询指定文件详情
     * @param string $file_id
     * @return array
     * @throws HttpException
     */
    public function getFilesById(string $file_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE,$file_id);
        try {
            return $this->get($url, [], $this->getHeader());
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }


}