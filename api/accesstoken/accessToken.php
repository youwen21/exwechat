<?php

namespace youwen\exwechat\api\accesstoken;

use youwen\exwechat\api\BaseApi;
use youwen\exwechat\api\http;

/**
 * 获取accessToken
 * @author baiyouwen <youwen21@yeah.net>
 */
class accessToken extends BaseApi
{
    // private $str = '{"access_token":"8-Ul_wDeEqs8dptGPrb5Mjdw05g9W705ot4cHeyq1rfyASsCJ7ZyIwltWNjFd3fTPClDmsZDwGL4Rxbh8IWCcpbKekubbMPCAeIKBre1dRydhe47UxwIqvKr3fjBf6lxJQTfAEAELO","expires_in":7200}';
    private $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

    private $appid;
    private $secret;
    public function __construct($appid='', $secret='')
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    /**
     * 从微信服务器获取accessToken
     * @return [type] [description]
     * @author baiyouwen
     */
    public function getAccessToken()
    {
        $url = sprintf($this->url, $this->appid, $this->secret);
        $ret = http::curl_get($url);
        if($this->debug){
            $this->logger->info('url:'.$this->url);
            $this->logger->info('outResult:', $ret);
        }
        return $this->HandleRet($ret);
    }

}
