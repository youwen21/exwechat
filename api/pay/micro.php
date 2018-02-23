<?php

namespace youwen\exwechat\api\pay;

use youwen\exwechat\api\BaseApi;
use youwen\exwechat\api\http;
use youwen\exwechat\exXMLMaker;

/**
 * 
 */
class micro extends BaseApi
{
    // 提交刷卡支付
    protected $micropay = 'https://api.mch.weixin.qq.com/pay/micropay';
    // 撤销订单 //需要双向证书
    protected $reverse = 'https://api.mch.weixin.qq.com/secapi/pay/reverse';
    // 交易保障
    protected $report = 'https://api.mch.weixin.qq.com/payitil/report';
    //转换短链接
    protected $shorturl = 'https://api.mch.weixin.qq.com/tools/shorturl';
    // 授权码查询openid
    protected $authcodetoopenid = 'https://api.mch.weixin.qq.com/tools/authcodetoopenid';
    //拉取订单评价数据
    protected $batchquerycomment = 'https://api.mch.weixin.qq.com/billcommentsp/batchquerycomment';

    public function reverse($xml, $cert)
    {
        $ret = http::sslpost($this->reverse, $xml, $cert);
        return $ret;
    }


}
