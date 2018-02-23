<?php

namespace youwen\exwechat\api\pay;

use youwen\exwechat\api\utils\common;

/**
* 统一下单-数据
*/
class UnifiedOrder extends OrderData
{

    function __construct(array $argument, $expireTime = 86400)
    {
        $this->_data['time_start'] = date('YmdHis');
        $expire = strtotime($this->_data['time_start']) + $expireTime;
        $this->_data['time_expire'] = date('YmdHis', $expire); // 交易结束时间
        $this->_data['nonce_str'] = common::createNonceStr();
        $this->_data['sign_type'] = 'MD5'; // 
        $this->_data['fee_type'] = 'CNY'; // 标价币种, 默认人民币：CNY

        $this->_data = array_merge($this->_data, $argument);
    }
}