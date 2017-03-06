<?php
namespace youwen\exwechat\api\user;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 */
class user extends AbstractApi
{
    private $urlUsers = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=%s';
    private $urlBlacklist = 'https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token=%s';
    private $urlUserInfo = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN';
    private $urlRemark = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=%s';


    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    /**
     * 获取用户列表
     * @param  string $next_openid [description]
     * @return [type]              [description]
     * @author baiyouwen
     */
    public function getUsers($next_openid='')
    {
        $url = sprintf($this->urlUsers, $this->token);
        if(!empty($next_openid)){
            $this->url.='&next_openid='.$next_openid;
        }
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    /**
     * 获取用户详细信息
     * @param  [type] $openid [description]
     * @return [type]         [description]
     * @author baiyouwen
     */
    public function getUserInfo($openid)
    {
        $url = sprintf($this->urlUserInfo, $this->token, $openid);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    /**
     * 获取黑名单列表
     * @param  string $begin_openid [description]
     * @return [type]               [description]
     * @author baiyouwen
     */
    public function getBlackList($begin_openid='')
    {
        $url = sprintf($this->urlBlacklist, $this->token);
        $data['begin_openid'] = $begin_openid;
        $ret = http::curl_post($url, $data);
        return $this->commenPart($ret);
    }

    public function remark($openid, $remark)
    {
        $url = sprintf($this->urlRemark, $this->token);
        $data['openid'] = $openid;
        $data['remark'] = $remark;
        $json = json_encode($data);
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }

}
