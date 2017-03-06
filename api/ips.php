<?php
namespace youwen\exwechat\api;

/**
 * 获取微信IP地址
 * @author baiyouwen <youwen21@yeah.net>
 */
class ips extends AbstractApi
{
    private $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=%s';

    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    public function getIps()
    {
        $url = sprintf($this->url, $this->token);
        $ret = http::curl_get($url);
        if(!$ret[0]){ // 正确执行
            $this->originalData = $ret[1];
            $this->data = json_decode($this->originalData, true);
        }else{ // 有错误码
            $this->errorCode = 0;
            $this->errorMsg = '';
        }
        return $this->data;
    }

}
