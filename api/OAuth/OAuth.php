<?php
namespace youwen\exwechat\api\Oauth;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;

/**
 * OAuth2.0鉴权
 * @author baiyouwen <youwen21@yeah.net>
 * @license [https://mp.weixin.qq.com/wiki] 微信网页开发 － 微信网页授权
 * 微信官网把网页授权接口调用凭证access_token与基础支持的access_token不同都叫access_token
 * 为方便理解，我把 基础支持的access_token叫access_token
 * OAuth中的access_token叫做oauth_token
 */
class OAuth extends AbstractApi
{
    // 第一步：用户同意授权，获取code scope(snsapi_base|snsapi_userinfo)
    private $step1 = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';
    // 第二步：通过code换取网页授权Oauth_token
    private $step2 = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
    // 第三步：拉取用户信息(需scope为 snsapi_userinfo, 为snsapi_base时执行第二步既完成) 
    private $step3 = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';
    // 刷新OAuth_token
    private $refresh_token = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=%s&grant_type=refresh_token&refresh_token=%s';
    // 检查OAuth_token是否有效
    private $check_token = 'https://api.weixin.qq.com/sns/auth?access_token=%s&openid=%s';


    private $appid;
    private $secret;
    public function __construct($appid='', $secret='')
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    public function getCodeUrl($redirect_uri, $scope='snsapi_base', $state='')
    {
        // $redirect_uri = urlEncode($redirect_uri);
        $url = sprintf($this->step1, $this->appid, $redirect_uri, $scope, $state);
        return $url;
    }

    public function getToken($code)
    {
        $url = sprintf($this->step2, $this->appid, $this->secret, $code);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    public function getUserInfo($oauth_token, $openid)
    {
        $url = sprintf($this->step3, $oauth_token, $openid);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    public function refreshToken($refresh_token)
    {
        $url = sprintf($this->refresh_token, $this->appid, $refresh_token);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    public function checkToken($oauth_token, $openid)
    {
        $url = sprintf($this->check_token, $oauth_token, $openid);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }
}
