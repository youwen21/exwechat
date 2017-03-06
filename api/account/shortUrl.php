<?php
namespace youwen\exwechat\api\account;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 */
class shortUrl extends AbstractApi
{
    private $url = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token=%s';


    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }
    
    public function create($url='')
    {
        $url = sprintf($this->url, $this->token);
        $data['action'] = 'long2short';
        $data['long_url'] = $url;
        $json = json_encode($data);
        $ret = http::curl_post($url, $json);
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
