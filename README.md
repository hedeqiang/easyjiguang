<h1 align="center"> jpush </h1>

<p align="center"> 极光推送 PHP Server SDK.</p>

> 如需友盟推送 请前往 [友盟推送](https://github.com/hedeqiang/UMeng-Push)

## 配置
在使用本扩展之前，你需要去 [极光](https://www.jiguang.cn/) 注册账号，进入开发者平台，然后创建应用，获取应用的 appKey 和 masterSecret。

## Installing

```shell
$ composer require hedeqiang/jpush -vvv
```

## Usage
```php
require __DIR__ .'/vendor/autoload.php';

use Hedeqiang\JPush\JPush;
use Hedeqiang\JPush\File;
use Hedeqiang\JPush\Device;
use Hedeqiang\JPush\Report;
use Hedeqiang\JPush\Schedule;
use Hedeqiang\JPush\Admin;

$config = [
    'appKey' => '',
    'masterSecret' => '',

    'groupKey' => '',
    'groupSecret' => '',

    'devKey' => '',
    'devSecret' => '',
];

$push = new JPush($config);
$file = new File($config);
$device = new Device($config);
$report = new Report($config);
$schedule = new Schedule($config);
$admin = new Admin($config);
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
return $push->message($options);
```

### 推送唯一标识符
```php
$query = [
   'count' => 1,
   'type'  => 'push',
];
return $push->getCid($query);
```

### 推送校验
```php
$options = [
    ...
    // 该 API 只用于验证推送调用是否能够成功，
    // 与推送 API 的区别在于：不向用户发送任何消息。 其他字段说明：同推送 API
];
return $push->validate($options);
```

### 批量单推 针对的是RegID方式批量单推
```php
$options = [
    ...
];
return $push->batchRegidSingle($options);
```

### 批量单推 针对的是Alias方式批量单推
```php
$options = [
    ...
];
return $push->batchAliasSingle($options);
```

### 推送撤销
```php
return $push->revoke($msgid);
```

### 文件推送
```php
$options = [
    ...
    'audience' => [
        'file' => ['file_id' => 'xxxx']
    ]
];
return $push->file($options);
```

### Group Push API：应用分组推送
```php
$options = [
    ...
];
return $push->groupPush($options);
```

### 应用分组文件推送（VIP专属接口）
```php
$options = [
    ...
];
return $push->groupPushFile($options);
```


## File API
### 上传文件
```php
$type = 'registration_id'; //type 文件类型，当前可取值为： alias、registration_id，不能为空。
return $file->files($type,fopen('xxx.txt','r'));
```

### 查询文件有效列表
```php
return $file->getFiles();
```

### 删除文件
```php
return $file->deleteFiles($file_id);
```

### 查询指定文件详情
```php
return $file->getFilesById($file_id);
```


## Report API 

### 送达统计详情（新）
```php
$query = [
    'msg_ids' => '1613113584,1229760629'
];
return $report->received($query);
```

### 送达状态查询
```php
$options = [
    'msg_id' => '',
    'registration_ids' => '',
    'date' => '' //可选
];
return $report->status($options);
```

### 消息统计详情（VIP 专属接口，新）
```php
$query = [
    'msg_ids' => '1613113584,1229760629'
];
return $report->detail($query);
```

### 用户统计（VIP 专属接口）
```php
$options = [
    'time_unit' => '',
    'start' => '',
    'duration' => ''
];
return $report->users($options);
```

### 分组统计-消息统计（VIP 专属接口）
```php
$query = [
    'group_msgids' => '1613113584,1229760629'
];
return $report->groupUsers($query);
```

### 分组统计-用户统计（VIP 专属接口）
```php
$options = [
    'time_unit' => '',
    'start' => '',
    'duration' => ''
];
return $report->groupUsers($options);
```

## Device API 

### 查询设备的别名与标签
```php
return $device->getDevices($registration_id);
```

### 设置设备的别名与标签
```php
$options = [
    'time_unit' => '',
    'start' => '',
    'duration' => ''
];
return $device->updateDevices($registration_id);
```

### 查询别名
```php
return $device->getAliases($alias_value, $platform = ['platform ' => 'all']);
```

### 删除别名
```php
return $device->deleteAliases($alias_value, $platform = ['platform ' => 'all']);
```

### 删除别名
```php
$options = [
    'registration_ids' => [
        'remove' => ['registration_id1','registration_id2']
    ]
];
return $device->removeAliases($alias_value, $options);
```


### 查询标签列表
```php
return $device->getTags();
```

### 判断设备与标签绑定关系
```php
return $device->isDeviceInTag($tag_value,$registration_id);
```

### 更新标签
```php
$options = [
    'registration_ids' => [
        'add' => ['registration_id1','registration_id2'],
        'remove' => ['registration_id1','registration_id2']
    ]
];
return $device->updateTag($tag_value,$options);
```

### 删除标签
```php
return $device->deleteTag($tag_value,$platform = ['platform ' => 'all']);
```

### 获取用户在线状态（VIP 专属接口）
```php
$options = [
    'registration_ids' => ['010b81b3582','0207870f1b8','0207870f9b8']
];
return $device->status($options);
```


## 在 Laravel 中使用

### 发布配置文件
```php
php artisan vendor:publish --tag=jpush
or 
php artisan vendor:publish --provider="Hedeqiang\JPush\JPushServiceProvider"
```

### 编写配置文件
```php
JPUSH_APP_KEY=
JPUSH_MASTER_SECRET=

JPUSH_GROUP_KEY=
JPUSH_GROUP_SECRET=

JPUSH_DEV_KEY=
JPUSH_DEV_SECRET=
```

### 使用

#### 方法参数注入
```php
use Hedeqiang\JPush\JPush;

public function index(JPush $push)
{
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
    return app('jpush.push')->message($options);
}
```

#### 服务名访问
```php
public function index()
{
    return app('jpush.push')->message($options);
}
```

#### Facades 门面使用(可以提示)
```php
use Hedeqiang\JPush\Facades\JPush;

public function index()
{
    return JPush::push()->message($options);
}
```

### 其他门面
```php
\Hedeqiang\JPush\Facades\JPush::file()->XXX
\Hedeqiang\JPush\Facades\JPush::report()->XXX
\Hedeqiang\JPush\Facades\JPush::device()->XXX
\Hedeqiang\JPush\Facades\JPush::schedule()->XXX
\Hedeqiang\JPush\Facades\JPush::admin()->XXX
```

更多用法参考：
- http://docs.jiguang.cn/jpush/server/push/server_overview/


> 能力有限 不可能都能测试到，（权限问题等）。遇到错误麻烦帮忙改进，谢谢。

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/hedeqiang/jpush/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/hedeqiang/jpush/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
