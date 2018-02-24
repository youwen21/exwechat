
# accesstoken是什么
https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140183

# 获取accesstoken DEMO

```
public function accessToken()
{
    $appid = 'wx';
    $appsecret = 'cf8e9db';

    $log = new Logger('message');
    $log->pushHandler(new StreamHandler(RUNTIME_PATH.'/exwechat/access.log', Logger::DEBUG));

    $access = new accessToken($appid, $appsecret);
    $access->setDebug(1);
    $access->setLogger($log);
    $token = $access->getAccessToken();
    exit(json_encode($token));
    // echo '<pre>';
    // print_r($token);
    // exit('</pre>');
}
```
