<?php
namespace youwen\exwechat\api\message;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 模板消息
 * @author baiyouwen <youwen21@yeah.net>
 */
class template extends AbstractApi
{
    // 设置所属行业 POST
    private $url_set_industry = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=%s';
    // 获取设置的行业信息 GET
    private $url_get_industry = 'https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=%s';
    // 获得模板ID POST
    private $url_add_template = 'https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=%s';
    // 获取模板列表 GET
    private $url_all_template = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=%s';
    // 删除模板 POST
    private $url_del_template = 'https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=%s';
    // 发送模板消息 POST
    private $url_send = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=%s';

    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    // 发送模板消息
    public function send($data)
    {
        $url = sprintf($this->url_send, $this->token);
        $json = is_array($data) ? json_encode($data) : $data;
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }

    // 设置所属行业
    public function set_industry($data)
    {
        $url = sprintf($this->url_add_template, $this->token);
        $json = is_array($data) ? json_encode($data) : $data;
        // echo '<pre>';
        // print_r( $json );
        // exit('</pre>');
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }

    // 获取设置的行业
    public function get_template_id()
    {
        $url = sprintf($this->url_add_template, $this->token);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    // 获取设置的行业
    public function get_industry()
    {
        $url = sprintf($this->url_get_industry, $this->token);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    // 获取模板列表
    public function get_all_template()
    {
        $url = sprintf($this->url_all_template, $this->token);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }
}
