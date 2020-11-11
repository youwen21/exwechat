<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 数据统计
 * Class UserSummary
 * @package youwen\exwechat\Request
 */
class UserSummary
{
    // 用户分析
    const GET_USER_SUMMARY = 'https://api.weixin.qq.com/datacube/getusersummary?access_token=ACCESS_TOKEN';
    // 用户分析
    const GET_USER_CUMULATE = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token=ACCESS_TOKEN';

    /**
     * 获取用户增减数据
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function getUserSummary($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::GET_USER_SUMMARY);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 获取累计用户数据
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function getUserCumulate($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::GET_USER_CUMULATE);
        return new Request('POST', $url, $body, $headers);
    }
}