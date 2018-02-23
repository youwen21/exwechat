<?php

namespace youwen\exwechat\api\pay;

use youwen\exwechat\api\BaseApi;
use youwen\exwechat\api\http;
use youwen\exwechat\XMLParse;
use youwen\exwechat\exXMLMaker;
use youwen\exwechat\api\pay\Pay;
use youwen\exwechat\api\pay\micro;


/**
 * 
 * 支付代理
 */
class payHelper
{
    private $signKey = '';
    private $payObj;

    private $debug = false;
    private $logger;
    /**
     * 支付助手类构造函数
     * @param  string  $signKey 签名字符串加密KEY
     * @param  object  $logger  符合PSR3标准的日志对象(monolog|klogger等)
     * @param  boolean $debug   是否调式模式,为真是记录详细日志
     * @author baiyouwen
     */
    public function __construct($signKey)
    {
        $this->signKey = $signKey;
        $this->payObj = new Pay();
    }

    public function setDebug($val)
    {
        $this->debug = $val;
        $this->payObj->setDebug($val);
    }
    public function setLogger($logger)
    {
        $this->logger = $logger;
        $this->payObj->setLogger($logger);
    }

    /**
     * 统一下单
     */
    public function unified(UnifiedOrder $inputOrder)
    {
        try{
            $orderData = $inputOrder->getData();
            $orderData['sign'] = PaySign::generateSign($orderData, $this->signKey);
            $xml = exXMLMaker::arrToXml($orderData);
            $ret = $this->payObj->unifiedorder($xml);
            if($ret[0]){
                if($this->logger)
                    $this->logger->debug('统一下单有错误!', $ret);
                return false;
            }
            return XMLParse::xmlToArray($ret[1]);
        }catch(\Exception $e){
            if($this->logger)
                $this->logger->debug('统一下单系统出错!', [$e->getCode(), $e->getMessage()]);
        }
    }

    /**
     * 扫支付模式1, 生成被扫的二维码信息,开发者自已转成二维码图片
     * 模式1回调操用需要开发者自已处理,可参见DEMO
     *
     * 回调地址,在微信支付平台中设置:
     * https://pay.weixin.qq.com/wiki/doc/api/native.php?chapter=6_3
     * 
     * 最终生成的二维码内容如下:
     * 'weixin://wxpay/bizpayurl?
     * sign=%s&appid=%s&mch_id=%s&product_id=%s&time_stamp=%s&nonce_str=%s'
     */
    public function scanPay1(OrderData $input)
    {
        $data = $input->getData();
        $data['sign'] = PaySign::generateSign($data, $this->signKey);
        $url = 'weixin://wxpay/bizpayurl?';
        foreach ($data as $key => $value) {
            $url.= $key.'='.$value.'&';
        }
        return rtrim($url, '&');
    }

    /** 
     * 扫码支付模式二
     * @return [type] [description]
     * @author baiyouwen
     * 预付单有效期为2小时,过期后无法支付
     */
    public function scanPay2(UnifiedOrder $inputOrder)
    {
        $arr = $this->unified($inputOrder);
        if(!$arr &&  !empty($this->logger)){
            $this->logger->debug('统一下单获取到的数据为空!');
            return false;
        }
        if($arr['result_code'] == 'SUCCESS' && $arr['return_code'] == 'SUCCESS'){
            return $arr['code_url'];
        }else{
            if($this->logger)
                $this->logger->debug('扫描支付2有错误!', $arr);
        }
    }

    /** 
     * 刷卡支付
     */
    public function microPay(OrderData $input)
    {
        try{
            $data = $input->getData();
            $data['sign'] = PaySign::generateSign($data, $this->signKey);
            $xml = exXMLMaker::arrToXml($data);
            $micropay = new micro();
            $ret = $micropay->micropay($xml);
            if($ret[0]){
                if($this->logger)
                    $this->logger->debug('刷卡支付有错误!', $ret);
                return false;
            }
            return XMLParse::xmlToArray($ret[1]);
        }catch(\Exception $e){
            if($this->logger)
                $this->logger->debug('统一下单系统出错!', [$e->getCode(), $e->getMessage()]);
        }
    }
}
