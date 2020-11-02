<?php

namespace youwen\exwechat\Request;

use youwen\exwechat\ApiBase;
use GuzzleHttp\Psr7\Request;

class Ips
{
    const IPS_URL = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=%s';

    public static function getIps(string $token)
    {
        $url = sprintf(self::IPS_URL, $token);
        return new Request('GET', $url);
    }
}
