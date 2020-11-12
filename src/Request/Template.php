<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 模板消息接口
 * Class Template
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Template_Message_Interface.html
 */
class Template
{
    // 设置所属行业 post
    const API_SET_INDUSTRY = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=ACCESS_TOKEN';

    // 获取设置的行业信息 get
    const GET_INDUSTRY = 'https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=ACCESS_TOKEN';

    // 获得模板ID post
    const API_ADD_TEMPLATE = 'https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=ACCESS_TOKEN';

    // 获取模板列表 get
    const GET_ALL_PRIVATE_TEMPLATE = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=ACCESS_TOKEN';

    // 删除模板 post
    const DEL_PRIVATE_TEMPLATE = 'https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=ACCESS_TOKEN';

    // 发送模板消息 post
    const MESSAGE_TEMPLATE_SEND = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=ACCESS_TOKEN';

    /**
     * 设置所属行业 post
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function apiSetIndustry($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::API_SET_INDUSTRY);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 获取设置的行业信息 get
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function getIndustry($accessToken, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::API_SET_INDUSTRY);
        return new Request('GET', $url, $headers);
    }

    /**
     * 获得模板ID post
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function apiAddTemplate($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::API_ADD_TEMPLATE);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 获取模板列表 get
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function getAllPrivateTemplate($accessToken, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::GET_ALL_PRIVATE_TEMPLATE);
        return new Request('GET', $url, $headers);
    }

    /**
     * 删除模板 post
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function delPrivateTemplate($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::DEL_PRIVATE_TEMPLATE);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 发送模板消息 post
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageTemplateSend($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_TEMPLATE_SEND);
        return new Request('POST', $url, $headers, $body);
    }
}