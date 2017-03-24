<?php
namespace youwen\exwechat\api\user;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 支付
 * @author baiyouwen <youwen21@yeah.net>
 * @license [https://mp.weixin.qq.com/wiki]
 */
class pay extends AbstractApi
{
    private $url = 'https://api.weixin.qq.com/datacube/%s?access_token=$s';


    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    /**
     * 用户分析数据接口
     * @param  string $interFase  [参数如下：数字为最大时间跨度]
     * 获取用户增减数据（getusersummary）7| 获取累计用户数据（getusercumulate）7
     * @param  string $begin_date [开始时间]
     * @param  string $end_date   [结束时间] 最大时间跨度为7是指最多一次性获取7天的数据
     * @return [type]             [description]
     * @author baiyouwen
     */
    public function userStatis($api='', $begin_date='', $end_date='')
    {
        if($end_date - $begin_date > 7){
            return false;
        }
        return $this->allStatis($interFase, $begin_date, $end_date);
    }

    /**
     * 图文分析数据接口
     * @param  string $interFase  [接口名称,参数如下：数字为最大时间跨度]
     * 获取图文群发每日数据（getarticlesummary） 1，获取图文群发总数据（getarticletotal） 1
     * 获取图文统计数据（getuserread）3，获取图文统计分时数据（getuserreadhour）1
     * 获取图文分享转发数据（getusershare） 7，获取图文分享转发分时数据（getusersharehour）1
     * @param  string $begin_date [开始时间]
     * @param  string $end_date   [结束时间]
     * @return [type]             [description]
     * @author baiyouwen
     */
    public function articleStatis($api='', $begin_date='', $end_date='')
    {
        return $this->allStatis($interFase, $begin_date, $end_date);
    }

    /**
     * 消息分析数据接口
     * @param  string $interFase  [接口名称,参数如下：数字为最大时间跨度]
     * 获取消息发送概况数据（getupstreammsg） 7，获取消息分送分时数据（getupstreammsghour） 1
     * 获取消息发送周数据（getupstreammsgweek）30，获取消息发送月数据（getupstreammsgmonth）30
     * 获取消息发送分布数据（getupstreammsgdist）15，获取消息发送分布周数据（getupstreammsgdistweek）30
     * 获取消息发送分布月数据（getupstreammsgdistmonth）30
     * @param  string $begin_date [开始时间]
     * @param  string $end_date   [结束时间]
     * @return [type]             [description]
     * @author baiyouwen
     */
    public function upstreamStatis($api='', $begin_date='', $end_date='')
    {
        return $this->allStatis($interFase, $begin_date, $end_date);
    }

    /**
     * 接口分析数据接口
     * @param  string $interFase  [接口名称,参数如下：数字为最大时间跨度]
     * 获取接口分析数据（getinterfacesummary）30，获取接口分析分时数据（getinterfacesummaryhour） 1
     * @param  string $begin_date [开始时间]
     * @param  string $end_date   [结束时间]
     * @return [type]             [description]
     * @author baiyouwen
     */
    public function interfaceStatis($interFase='', $begin_date='', $end_date='')
    {
        return $this->allStatis($interFase, $begin_date, $end_date);
    }

    public function allStatis($interFase='', $begin_date='', $end_date='')
    {
        $url = sprintf($this->url, $api, $this->token);
        $json = json_encode(['begin_date'=>$begin_date, 'end_date'=>$end_date]);
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }
}
