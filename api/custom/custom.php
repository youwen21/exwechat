<?php
namespace youwen\exwechat\api\custom;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 */
class custom extends AbstractApi
{
    private $urladd = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=%s';
    private $urlupdate = 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=%s';
    private $urldel = 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=%s';
    private $urlheadimg = 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=%s&kf_account=KFACCOUNT';
    private $urlkflist = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=%s';
    private $urlsend = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=%s';

    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    public function customAdd()
    {
    	$url = sprintf($this->urladd, $this->token);
    	if(!empty($next_openid)){
    	    $this->url.='&next_openid='.$next_openid;
    	}
    	$ret = http::curl_get($url);
    	return $this->commenPart($ret);
    }

    public function customList()
    {
        $url = sprintf($this->urlkflist, $this->token);
        // if(!empty($next_openid)){
        //     $this->url.='&next_openid='.$next_openid;
        // }
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }


}
