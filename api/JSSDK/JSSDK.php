<?php
namespace youwen\exwechat\api\JSSDK;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;

/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 */
class JSSDK extends AbstractApi
{
    private $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi';

    private $token;
    public function __construct($token = '')
    {
        $this->token = $token;
    }

    /**
     * 获取jsapi_ticket
     * @return [type]              [description]
     * @author baiyouwen
     * 正常情况下，jsapi_ticket的有效期为7200秒
     * 获取jsapi_ticket的api调用次数非常有限，需缓存jsapi_ticket
     */
    public function get_jsapi_ticket()
    {
        $url = sprintf($this->url, $this->token);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    /**
     * 生成签名
     * @param  [type] $jsapi_ticket [ticket凭证]
     * @param  [type] $noncestr     [随机字符串]
     * @param  [type] $timestamp    [时间戳]
     * @param  [type] $url          [要使用JSSDK的url地址]
     * @return [type]               [signature签名]
     * @author baiyouwen
     */
    public function signature($jsapi_ticket, $noncestr, $timestamp, $url)
    {
        $str = "jsapi_ticket=$jsapi_ticket&noncestr=$noncestr&timestamp=$timestamp&url=$url";
        $signature = sha1($str);
        return $signature;
    }

    public function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    public function jsApiList()
    {
        $str = implode('","', $this->apiList);
        $listStr = '"'.$str.'"';
        return $listStr;
    }

    public $apiList = [
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'onVoicePlayEnd',
        'uploadVoice',
        'downloadVoice',
        'chooseImage',
        'previewImage',
        'uploadImage',
        'downloadImage',
        'translateVoice',
        'getNetworkType',
        'openLocation',
        'getLocation',
        'hideOptionMenu',
        'showOptionMenu',
        'hideMenuItems',
        'showMenuItems',
        'hideAllNonBaseMenuItem',
        'showAllNonBaseMenuItem',
        'closeWindow',
        'scanQRCode',
        'chooseWXPay',
        'openProductSpecificView',
        'addCard',
        'chooseCard',
        'openCard',
    ];
}
