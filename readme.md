# exwechat是一个微信公众号开发包

# 开发设计原则

## Request目录类文件是一个接口类目，每一个方法返一个http request对象
 Request目录下每个类文件对应一个微信公众号开发文档的一个类目  
 如Request\AccessToken文件对应：https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_access_token.html

## ApiClient,所有api请求都由此发出。
 ApiClient



# 重要组成
- Config 微信公众号配置管理
- Cache  实现Psr\SimpleCache\CacheInterface PSR协议的缓存包
- TokenManager 依赖Config和Cache， 从微信api获得access_token，缓存它。
- ApiClient， 包装GuzzleHttp/Client
- requests, 每一个request都对应微信公众号的API

TokenManager 和 ApiClient是最重要的两个类。  
TokenManager 调度cache缓存access_token。 另外从微信公众号获得access_token。  
ApiClient 包装GuzzleHttp/Client, xmlProcessor, jsonProcessor三个类。
一部分调用微信公众号接口，另一部分是处理response返回的xml和json内容为array数组。



# 如何记录日志
guzzle http middleware 可以设置中间件，通过中间件记录日志  
推荐:
> https://github.com/gmponos/guzzle-log-middleware

> https://github.com/namshi/cuzzle

# DEMO1
```php
$redis = RedisFactory::create();
$redisCache = new RedisCache($redis);
$config = [
    'app_id' => '',
    'secret' => '',
    'redirect_uri' => '',
];

$tokenManager = new TokenManager($config, $redisCache);
$token = $tokenManager->getAccessToken();
$api = new ApiClient();

$ipRequest = (new Ips)->getIps($token);
$response = $api->send($ipRequest);
```

# DEMO2
```php
// facade
$redis = RedisFactory::create();
$redisCache = new RedisCache($redis);
$config = [
    'app_id' => '',
    'secret' => '',
    'redirect_uri' => '',
];

$tokenManager = new TokenManager($config, $redisCache);
$token = $tokenManager->getAccessToken();
$api = new ApiClient();

$facade = new WechatFacade($tokenManager, $api);

$ips = $facade->getIps();
```
