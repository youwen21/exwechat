<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

class AccessToken
{
    const TOKEN_URL = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

    public static function getAccessToken($appid = null, $secret = null)
    {
        $url = sprintf(self::TOKEN_URL, $appid, $secret);
        return new Request('GET', $url);
    }
}
