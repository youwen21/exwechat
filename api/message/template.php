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

    public function uploadimg($img='')
    {
    	$url = sprintf($this->urlUploadimg, $this->token);
        // $file = $_SERVER['DOCUMENT_ROOT'] . ltrim($matinfo['localpath'], '.');
        // $file = realpath('./Uploads/wechatpic/sys/53abe32d5b8d8.jpeg');
        $file = str_replace("\\", "/", realpath($img));
        $data = array();
        // $data['media'] = '@'.$file;  //php5.5前
        $data['media'] = new \CURLFile($file); // php5.5后
    	$ret = http::curl_post($url, $data);
    	return $this->commenPart($ret);
    }

    public function uploadnews($data)
    {
        $url = sprintf($this->urlUploadnews, $this->token);
        $json = is_array($data) ? json_encode($data, JSON_UNESCAPED_UNICODE) : $data;
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }
}
