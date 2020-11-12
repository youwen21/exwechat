<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 客服消息
 * Class CustomService
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html
 */
class CustomService
{
    // 客服帐号管理 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#0

    // 添加客服帐号 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#1
    const KF_ACCOUNT_ADD = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=ACCESS_TOKEN';
    // 修改客服帐号 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#2
    const KF_ACCOUNT_UPDATE = 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=ACCESS_TOKEN';
    // 删除客服帐号 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#3
    const KF_ACCOUNT_DEL = 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=ACCESS_TOKEN';
    // 设置客服帐号的头像 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#4
    const KF_ACCOUNT_UPDATE_HEAD_IMG = 'POST/FORM http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=ACCESS_TOKEN&kf_account=KFACCOUNT';
    // 获取所有客服账号 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#5
    const GET_KF_LIST = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=ACCESS_TOKEN';

    // 客服接口-发消息 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#7
    const CUSTOM_SEND = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=ACCESS_TOKEN';
    // 客服输入状态 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html#8
    const CUSTOM_TYPING = 'https://api.weixin.qq.com/cgi-bin/message/custom/typing?access_token=ACCESS_TOKEN';

    /**
     * 添加客服帐号
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function kfAccountAdd($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::KF_ACCOUNT_ADD);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 修改客服帐号
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function kfAccountUpdate($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::KF_ACCOUNT_UPDATE);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 删除客服帐号
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function kfAccountDel($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::KF_ACCOUNT_DEL);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 设置客服帐号的头像
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function kfAccountUpdateHeadImg($accountId, $accessToken, $body, $headers = [])
    {
        $search = ['ACCESS_TOKEN', 'KFACCOUNT'];
        $replace = [$accessToken, $accountId];
        $url = str_replace($search, $replace, self::KF_ACCOUNT_UPDATE_HEAD_IMG);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 获取所有客服账号
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function kfAccountList($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::GET_KF_LIST);
        return new Request('GET', $url, $body, $headers);
    }

    /**
     * 客服接口-发消息
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function customSend($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::CUSTOM_SEND);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 客服输入状态
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function customTyping($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::CUSTOM_TYPING);
        return new Request('POST', $url, $headers, $body);
    }
}