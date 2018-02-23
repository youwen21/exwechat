<?php

namespace youwen\exwechat\api\pay;

/**
 * 统一下单的sign和JSSDK_chooseWXPay中的paySign是一样的签名算法
* https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=4_3
*
* 使用支付接口需要设置域名， 设置地址为：
* 微信支付平台：产品中心－〉开发配置
*/
class PaySign
{

    public static function generateSign(array $data, $signKey)
    {
        ksort($data);
        $stringA = '';
        foreach ($data as $key => $value) {
            if(!is_numeric($value) && empty($value)){
                continue;
            }
            $stringA.= $key .= '=' . $value . '&';
        }
        $stringSignTemp = $stringA.'key='.$signKey;
        return strtoupper(md5($stringSignTemp));
    }
}