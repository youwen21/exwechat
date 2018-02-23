<?php

namespace youwen\exwechat\api\pay;

use youwen\exwechat\api\BaseApi;
use youwen\exwechat\api\http;
use youwen\exwechat\exXMLMaker;

/**
 * 支付
 * 公众号支付步骤：
 * 1,统一下单 
 * 2,H5内jssdk调起支付
 * @author baiyouwen <youwen21@yeah.net>
 * @license [https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=9_1]
 * 
 * 统一下单是一个逻辑比较麻烦的接口,除刷卡支付外其他支付方式都会调用
 * 申请退款和刷卡支付的撤销订单是一个需要证书才能请求的接口
 * 其他接口都是普通接口,只要数据正确,签名正确就可以
 */
class Pay extends BaseApi
{
    // 统一下单
    protected $unifiedorder = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    // 查询订单
    protected $orderquery = 'https://api.mch.weixin.qq.com/pay/orderquery';
    // 关闭订单
    protected $closeorder = 'https://api.mch.weixin.qq.com/pay/closeorder';
    // 下载对账单
    protected $downloadbill = 'https://api.mch.weixin.qq.com/pay/downloadbill';
    // 申请退款，每秒不超过150次，需要证书
    protected $refund = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
    // 查询退款
    protected $refundquery = 'https://api.mch.weixin.qq.com/pay/refundquery';

}
