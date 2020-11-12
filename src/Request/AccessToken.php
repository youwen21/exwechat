<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 开始开发
 * Class AccessToken
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_access_token.html
 */
class AccessToken
{
    // 获取Access token
    const TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

    /**
     * @param null $appid
     * @param null $secret
     * @return Request
     */
    public static function getAccessToken($appid = null, $secret = null)
    {
        $url = sprintf(self::TOKEN_URL, $appid, $secret);
        return new Request('GET', $url);
    }
}
