# exwechat是一个微信公众号开发包

# 重要组成
- Config 微信公众号配置管理
- Cache  实现Psr\SimpleCache\CacheInterface PSR协议的缓存包
- TokenManager 依赖Config和Cache， 从微信api获得access_token，缓存它。
- ApiClient， 包装GuzzleHttp/Client
- requests, 每一个request都对应微信公众号的API


# DEMO
```php
// 
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
