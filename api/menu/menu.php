<?php
namespace youwen\exwechat\api\menu;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;

/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 * @license [https://mp.weixin.qq.com/wiki]
 */
class menu extends AbstractApi
{
    private $urlMenuGet = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=%s';
    private $urlMenuCreate = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s';
    private $urlMenuDelete = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=%s';
    private $urlConditional = 'https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=%s';
    private $urlMenuInfo = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=%s';

    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    /**
     * 当前公众号的菜单
     * @author baiyouwen
     */
    public function get()
    {
        $url = sprintf($this->urlMenuGet, $this->token);
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

    /** 
     * 菜单信息 － 与menu Get稍有不同
     * @author baiyouwen
     */
    public function menuInfo()
    {
        $url = sprintf($this->urlMenuInfo, $this->token);
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
    /**
     * 生成公众号菜单
     * @param  array $data 菜单数组
     * @author baiyouwen
     * @license [https://mp.weixin.qq.com/wiki] [自定义菜单－自定义菜单创建接口]
     */
    public function create($data)
    {
        $url = sprintf($this->urlMenuCreate, $this->token);
        $json = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
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

    public function delete()
    {
        $url = sprintf($this->urlMenuDelete, $this->token);
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
