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
    const GET_USER_CUMULATE = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token=ACCESS_TOKEN';

    // 图文分析 - 数据魔方
    // 获取图文群发每日数据（getarticlesummary）
    const GET_ARTICLE_SUMMARY = 'https://api.weixin.qq.com/datacube/getarticlesummary?access_token=ACCESS_TOKEN';
    // 获取图文群发总数据（getarticletotal）
    const GET_ARTICLE_TOTAL = 'https://api.weixin.qq.com/datacube/getarticletotal?access_token=ACCESS_TOKEN';
    // 获取图文统计数据（getuserread）
    const GET_USER_READ = 'https://api.weixin.qq.com/datacube/getuserread?access_token=ACCESS_TOKEN';
    // 获取图文统计分时数据（getuserreadhour）
    const GET_USER_READ_HOUR = 'https://api.weixin.qq.com/datacube/getuserreadhour?access_token=ACCESS_TOKEN';
    // 获取图文分享转发数据（getusershare）
    const GET_USER_SHARE = 'https://api.weixin.qq.com/datacube/getusershare?access_token=ACCESS_TOKEN';
    // 获取图文分享转发分时数据（getusersharehour）
    const GET_USER_SHARE_HOUR = 'https://api.weixin.qq.com/datacube/getusersharehour?access_token=ACCESS_TOKEN';


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

    /**
     * 图文分析 - 数据魔方
     * @param $dataQubeUrl
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function dataCube($dataQubeUrl, $accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, $dataQubeUrl);
        return new Request('POST', $url, $body, $headers);
    }
}