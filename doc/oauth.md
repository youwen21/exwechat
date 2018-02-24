
# 微信网页授权
https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140842

## 微信网页授权 DEMO

```php

public function snsapi_base()
{

    $redirect_uri = url('callback_base','', false, true);
    $scope = 'snsapi_base';
    $state = '123';
    $redirect_uri = urlencode($redirect_uri);
    $OAuth = new OAuth($this->appid, $this->secret);
    $url = $OAuth->getCodeUrl($redirect_uri, $scope, $state);
    header('Location: '.$url);
    exit();
    // $this->assign('url', $url);
    // $this->assign('redirect_uri', $redirect_uri);
    // return $this->fetch();
}

public function snsapi_userinfo()
{
    $redirect_uri = url('callback_userinfo','', false, true);
    $scope = 'snsapi_userinfo';
    $state = '123';
    $redirect_uri = urlencode($redirect_uri);
    $OAuth = new OAuth($this->appid, $this->secret);
    $url = $OAuth->getCodeUrl($redirect_uri, $scope, $state);
    header('Location: '.$url);
    exit();
    // $this->assign('url', $url);
    // $this->assign('redirect_uri', $redirect_uri);
    // return $this->fetch();
}



public function callback_base()
{
    define(CURL_LOG, true);
    $OAuth = new OAuth($this->appid, $this->secret);
    $ret = $OAuth->getToken(Request::instance()->get('code'));
    if(isset($ret['errcode'])){
        echo '<pre>';
        print_r( $ret );
        exit('</pre>');
    }
    echo '<pre>';
    // echo '<pre>';
    // print_r( $_SERVER );
    // print_r(Request::instance()->get([]));
    // exit('</pre>');
    // $this->_saveAccess($ret);
    echo '<br/>';
    print_r( $ret );
    exit('</pre>');
}

public function callback_userinfo()
{
    define(CURL_LOG, true);
    $OAuth = new OAuth($this->appid, $this->secret);
    $ret = $OAuth->getToken(Request::instance()->get('code'));
    if(isset($ret['errcode'])){
        echo '<pre>';
        print_r( $ret );
        exit('</pre>');
    }
    $info = $OAuth->getUserInfo($ret['access_token'], $ret['openid']);
    if(isset($info['errcode'])){
        echo '<pre>';
        print_r( $info );
        exit('</pre>');
    }
    $check = $OAuth->checkToken($ret['access_token'], $ret['openid']);
    // $refresh = $OAuth->refreshToken($ret['refresh_token']);

    // $this->_saveAccess($ret);
    // $this->_saveUserInfo($info);

    header("Content-type: text/html; charset=utf-8"); 
    echo '<pre>';
    print_r( $_GET );
    echo '<br/>';
    print_r( $ret );
    echo '<br/>';
    print_r( $info );
    echo '<br/>';
    print_r( $check );
    echo '<br/>';
    print_r( $refresh );
    exit('</pre>');
}

```
