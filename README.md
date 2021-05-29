<h1 align="center"> JIGUANG </h1>

<p align="center"> 极光 API Server SDK for PHP.</p>

> 如需友盟推送 请前往 [友盟推送](https://github.com/hedeqiang/UMeng-Push)

## 配置

在使用本扩展之前，你需要去 [极光](https://www.jiguang.cn/) 注册账号，进入开发者平台，然后创建应用，获取应用的 appKey 和 masterSecret。

## Installing

```shell
$ composer require hedeqiang/easyjiguang -vvv
```

## Usage

```php
require __DIR__ .'/vendor/autoload.php';


$config = [
    'appKey'       => 'XXX',
    'masterSecret' => 'XXX',

    'groupKey'    => 'XXX',
    'groupSecret' => 'XXX',

    'devKey'        => 'XXX',
    'devSecret'     => 'XXX',

    /*
     * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
     */
    'response_type' => 'array',


    /**
     * 日志配置
     *
     * level: 日志级别, 可选为：
     *         debug/info/notice/warning/error/critical/alert/emergency
     * path：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log'           => [
        'default'  => env('APP_DEBUG', false) ? 'dev' : 'prod', // 默认使用的 channel，生产环境可以改为下面的 prod
        'channels' => [
            // 测试环境
            'dev'  => [
                'driver' => 'single',
                'path'   => '/tmp/push.log',
                'level'  => 'debug',
            ],
            // 生产环境
            'prod' => [
                'driver' => 'daily',
                'path'   => '/tmp/push.log',
                'level'  => 'info',
            ],
        ],
    ],
];
$app = \EasyJiGuang\Factory::JPush($config);

```

## Push API

> 请求参数详见：http://docs.jiguang.cn/jpush/server/push/rest_api_v3_push/

### 推送消息

```php
$options = [
    'platform' => 'all',
    'audience' => ['registration_id' => ['1']],
    'notification' => [
        'alert' => 'Hello',
        'android' => [],
        'ios' => [
            'extras' => ['newsid' => '123']
        ]
    ],
    ...
];
return $app->push->message($options);
```

### 推送唯一标识符

```php
$options = [
   'count' => 1,
   'type'  => 'push',
];
return $app->push->getCid($options);
```

### 推送校验

```php
$options = [
    ...
    // 该 API 只用于验证推送调用是否能够成功，
    // 与推送 API 的区别在于：不向用户发送任何消息。 其他字段说明：同推送 API
];
return $app->push->validate($options);
```

### 批量单推 针对的是RegID方式批量单推

```php
$options = [
    ...
];
return $app->push->batchRegidSingle($options);
```

### 批量单推 针对的是Alias方式批量单推

```php
$options = [
    ...
];
return $app->push->batchAliasSingle($options);
```

### 推送撤销

```php
return $app->push->revoke($msgid);
```

### 文件推送

```php
$options = [
    ...
    'audience' => [
        'file' => ['file_id' => 'xxxx']
    ]
];
return $app->push->file($options);
```

### Group Push API：应用分组推送

```php
$options = [
    ...
];
return $app->push->groupPush($options);
```

### 应用分组文件推送（VIP专属接口）

```php
$options = [
    ...
];
return $app->push->groupPushFile($options);
```

## File API

> 请求参数详见：http://docs.jiguang.cn/jpush/server/push/rest_api_v3_file/

### 上传文件

```php
$type = 'registration_id'; //type 文件类型，当前可取值为： alias、registration_id，不能为空。
return $app->file->files($type,['filename' => 'xxx.txt']);
```

### 查询文件有效列表

```php
return $app->file->getFiles();
```

### 删除文件

```php
return $app->file->deleteFiles($file_id);
```

### 查询指定文件详情

```php
return $app->file->getFilesById($file_id);
```

## Report API

> 请求参数详见：http://docs.jiguang.cn/jpush/server/push/rest_api_v3_report/

### 送达统计详情（新）

```php
$query = [
    'msg_ids' => '1613113584,1229760629'
];
return $app->report->received($query);
```

### 送达状态查询

```php
$options = [
    'msg_id' => '',
    'registration_ids' => '',
    'date' => '' //可选
];
return $app->report->status($options);
```

### 消息统计详情（VIP 专属接口，新）

```php
$query = [
    'msg_ids' => '1613113584,1229760629'
];
return $app->report->detail($query);
```

### 用户统计（VIP 专属接口）

```php
$options = [
    'time_unit' => '',
    'start' => '',
    'duration' => ''
];
return $app->report->users($options);
```

### 分组统计-消息统计（VIP 专属接口）

```php
$query = [
    'group_msgids' => '1613113584,1229760629'
];
return $app->report->groupUsers($query);
```

### 分组统计-用户统计（VIP 专属接口）

```php
$options = [
    'time_unit' => '',
    'start' => '',
    'duration' => ''
];
return $app->report->groupUsers($options);
```

## Device API

> 请求参数详见：http://docs.jiguang.cn/jpush/server/push/rest_api_v3_device/

### 查询设备的别名与标签

```php
return $app->device->getDevices($registration_id);
```

### 设置设备的别名与标签

```php
$options = [
    'tags'   => [
        'add'    => ['tag1', 'tag2'],
        'remove' => ['tag3', 'tag4']
    ],
    'alias'  => 'alias1',
    'mobile' => '13012345678'
];
return $app->device->updateDevices($registration_id,$options);
```

### 查询别名

```php
return $app->device->getAliases($alias_value, $platform = ['platform ' => 'all']);
```

### 删除别名

```php
return $app->device->deleteAliases($alias_value, $platform = ['platform ' => 'all']);
```

### 解绑设备与别名的绑定关系

```php
$options = [
    'registration_ids' => [
        'remove' => ['registration_id1','registration_id2']
    ]
];
return $app->device->removeAliases($alias_value, $options);
```

### 查询标签列表

```php
return $app->device->getTags();
```

### 判断设备与标签绑定关系

```php
return $app->device->isDeviceInTag($tag_value,$registration_id);
```

### 更新标签

```php
$options = [
    'registration_ids' => [
        'add' => ['registration_id1','registration_id2'],
        'remove' => ['registration_id1','registration_id2']
    ]
];
return $app->device->updateTag($tag_value,$options);
```

### 删除标签

```php
return $app->device->deleteTag($tag_value,$platform = ['platform ' => 'all']);
```

### 获取用户在线状态（VIP 专属接口）

```php
$options = [
    'registration_ids' => ['010b81b3582','0207870f1b8','0207870f9b8']
];
return $app->device->status($options);
```


## 极光认证
> 请求参数 详见： https://docs.jiguang.cn/jverification/server/rest_api/rest_api_summary/
```php
$app = \EasyJiGuang\Factory::JVerify($config);

$options = [
    'token' => 'xxx',
    'phone' => 'xxx',
    'exID'  => 'xxx',
];
// 号码认证 提交手机号码和token，验证是否一致
$app->verify->verify($options);
// 一键登录 提交loginToken，验证后返回手机号码
$app->verify->loginTokenVerify('xxx','xxx');
```

More...

## 在 Laravel 中使用

### 发布配置文件

```php
php artisan vendor:publish --tag=jiguang
or 
php artisan vendor:publish --provider="EasyJiGuang\ServiceProvider"
```

### 使用

#### 服务名访问

```php
public function index()
{
    return app('push')->push->message($options);
}
```

#### Facades 门面使用(可以提示)

```php
use EasyJiGuang\Facades\EasyJiGuang;

public function index()
{
    return EasyJiGuang::JPush()->push->message($options);
}
```

### 其他门面

```php
EasyJiGuang::JVerify()->verify->verify();
.
.
.
```

更多用法参考：

- http://docs.jiguang.cn/jpush/server/push/server_overview/
- https://docs.jiguang.cn/jverification/server/rest_api/rest_api_summary/
> 能力有限 不可能都能测试到，（权限问题等）。遇到错误麻烦帮忙改进，谢谢。

# 鸣谢
[EasyWechat](https://github.com/w7corp/easywechat)
> 文中大量代码来自 EasyWechat ，超哥写的代码简直太优雅、太完美。

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/hedeqiang/jpush/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/hedeqiang/jpush/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
