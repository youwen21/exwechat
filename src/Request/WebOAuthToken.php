<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * Class WebAccessToken
 * @package youwen\exwechat\Api
 *
 * @see https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html#0
 */
class WebOAuthToken
{
    const OPENID_SCOPE = 'snsapi_base';
    const USER_INFO_SCOPE = 'snsapi_userinfo';

    // scope code
    const SCOPE_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';
    // web Oauth access token
    const OAUTH_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
    // userInfo
    const USER_INFO_URL = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';
    // refresh web Oauth access token
    const REFRESH_OAUTH_TOKEN_URL = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=%s&grant_type=refresh_token&refresh_token=%s';
    // check web Oauth access token
    const CHECK_OAUTH_TOKEN_URL = 'https://api.weixin.qq.com/sns/auth?access_token=%s&openid=%s';

    public static function getScopeCodeUrl($appid, $redirectUri, $scope = 'snsapi_base', $state = 0)
    {
        $url = sprintf(self::SCOPE_URL, $appid, $redirectUri, $scope, $state);
        return $url;
    }

    public static function getOauthToken($appid, $secret, $code)
    {
        $url = sprintf(self::OAUTH_TOKEN_URL, $appid, $secret, $code);
        return new Request('GET', $url);
    }

    public static function getUserInfo($OauthAccessToken, $openid)
    {
        $url = sprintf(self::USER_INFO_URL, $OauthAccessToken, $openid);
        return new Request('GET', $url);
    }

    public static function refreshOauthToken($appid, $refreshToken)
    {
        $url = sprintf(self::REFRESH_OAUTH_TOKEN_URL, $appid, $refreshToken);
        return new Request('GET', $url);
    }

    public static function checkOauthToken($OauthAccessToken, $openid)
    {
        $url = sprintf(self::CHECK_OAUTH_TOKEN_URL, $OauthAccessToken, $openid);
        return new Request('GET', $url);
    }
}
