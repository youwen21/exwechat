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

    // 消息分析 - 数据魔方
    // 获取消息发送概况数据（getupstreammsg）
    const GET_UPSTREAM_MSG = 'https://api.weixin.qq.com/datacube/getupstreammsg?access_token=ACCESS_TOKEN';
    // 获取消息分送分时数据（getupstreammsghour）
    const GET_UPSTREAM_MSG_HOUR = 'https://api.weixin.qq.com/datacube/getupstreammsghour?access_token=ACCESS_TOKEN';
    // 获取消息发送周数据（getupstreammsgweek）
    const GET_UPSTREAM_MSG_WEEK = 'https://api.weixin.qq.com/datacube/getupstreammsgweek?access_token=ACCESS_TOKEN';
    // 获取消息发送月数据（getupstreammsgmonth）
    const GET_UPSTREAM_MSG_MONTH = 'https://api.weixin.qq.com/datacube/getupstreammsgmonth?access_token=ACCESS_TOKEN';
    // 获取消息发送分布数据（getupstreammsgdist）
    const GET_UPSTREAM_MSG_DIST = 'https://api.weixin.qq.com/datacube/getupstreammsgdist?access_token=ACCESS_TOKEN';
    // 获取消息发送分布周数据（getupstreammsgdistweek）
    const GET_UPSTREAM_MSG_DIST_WEEK = 'https://api.weixin.qq.com/datacube/getupstreammsgdistweek?access_token=ACCESS_TOKEN';
    // 获取消息发送分布月数据（getupstreammsgdistmonth）
    const GET_UPSTREAM_MSG_DIST_MONTH = 'https://api.weixin.qq.com/datacube/getupstreammsgdistmonth?access_token=ACCESS_TOKEN';

    // 广告分析
    // 分广告位数据
    const PUBLISHER_ADPOS_GENERAL = 'https://api.weixin.qq.com/publisher/stat?action=publisher_adpos_general&access_token=ACCESS_TOKEN';
    // 返佣商品数据
    const PUBLISHER_CPS_GENERAL = 'https://api.weixin.qq.com/publisher/stat?action=publisher_cps_general&access_token=ACCESS_TOKEN';
    // 结算收入数据及结算主体信息
    const PUBLISHER_SETTLEMENT = 'https://api.weixin.qq.com/publisher/stat?action=publisher_settlement&access_token=ACCESS_TOKEN';

    // 接口分析
    // 获取接口分析数据（getinterfacesummary）
    const GET_INTERFACE_SUMMARY = 'https://api.weixin.qq.com/datacube/getinterfacesummary?access_token=ACCESS_TOKEN';
    // 获取接口分析分时数据（getinterfacesummaryhour）
    const GET_INTERFACE_SUMMARY_HOUR = 'https://api.weixin.qq.com/datacube/getinterfacesummaryhour?access_token=ACCESS_TOKEN';


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
        return new Request('POST', $url, $headers, $body);
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
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 图文分析 - 数据魔方
     * 消息分析 - 数据魔方
     * @param $dataQubeUrl
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function dataCube($dataQubeUrl, $accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, $dataQubeUrl);
        return new Request('POST', $url, $headers, $body);
    }
}