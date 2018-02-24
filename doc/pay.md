# 微信支付
## 公众号支付
https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=7_1
## 扫码支付
https://pay.weixin.qq.com/wiki/doc/api/native.php?chapter=6_1
## 刷卡支付
https://pay.weixin.qq.com/wiki/doc/api/micropay.php?chapter=5_1

## H5支付
https://pay.weixin.qq.com/wiki/doc/api/H5.php?chapter=15_1

# 简单说明:
公众号支付是在微信内打开HTML页面,使用JSSDK发起支付  
扫码支付是开发者根据一定开发生成一个二维码展示给用户, 用户微信扫一扫支付  
刷卡支付是用户展示付款二维码,开发者使用扫码设备扫描用户二维码实现支付
H5支付(暂未开发,不清除,不讨论)

### 公众号支付DEMO
[JSSDK支付](jssdk_pay.md)

### 扫码DEMO
```
// 模式一
public function scanpay1()
{
    $conf = Conf::getConf();
    $data['appid'] = $conf['appid'];
    $data['mch_id'] = '1498244852';
    $data['product_id'] = '11';
    $data['time_stamp'] = time();
    $data['nonce_str'] = '123';

    $orderData = new OrderData($data);

    $helper = new payHelper('82d18ce');
    $ret = $helper->scanPay1($orderData);
    // echo '<pre>';
    // print_r( $ret );
    // exit('</pre>');
    $qrCode = new QrCode($ret);
    header('Content-Type: '.$qrCode->getContentType());
    echo $qrCode->writeString();
    exit;
}

// 模式二
public function scanpay2()
{
    \think\Cache::inc('out_trade_no');
    $conf = Conf::getConf();
    //必要参数
    // 需要接口传过来的有4个
    $wxConf['body'] = '测试商品'; //商品(订单)描述
    $wxConf['out_trade_no'] = (string)\think\Cache::get('out_trade_no');; //从123开始，唯一订单号
    $wxConf['total_fee'] = '1'; // 订单总金额
    $wxConf['spbill_create_ip'] = \Think\Request::instance()->ip();

    $wxConf['openid'] = 'oLlT-1CSztIM8hTv70spCGhhQtzc';
    $wxConf['appid'] = $conf['appid'];
    $wxConf['mch_id'] = '1498244852';
    $wxConf['notify_url'] = url('demojssdk/paynotify','', true, true);
    $wxConf['trade_type'] = 'NATIVE'; // 交易类型

    $wxConf['nonce_str'] = '123456789';

    $input = new UnifiedOrder($wxConf);

    $pay = new payHelper('82d18ce');
    $ret = $pay->unified($input);
    $qrCode = new QrCode($ret['code_url']);
    header('Content-Type: '.$qrCode->getContentType());
    echo $qrCode->writeString();
    exit;
}


/**
 * 模式一
 * 第二步，回调接收参数， 请求统一下单接口
 * @return [type] [description]
 * @author baiyouwen
 */
public function scanCallback()
{
    $req = $this->request->url(true);
    $xml = file_get_contents('php://input');

    file_put_contents(RUNTIME_PATH.'/scanpay.log', $req.PHP_EOL, FILE_APPEND);
    file_put_contents(RUNTIME_PATH.'/scanpay.log', $xml.PHP_EOL, FILE_APPEND);

    $arr = XMLParse::xmlToArray($xml);
    $ret = $this->_unified($arr);
    if($ret['result_code'] != 'SUCCESS'){

    }else{
        // $preArr = XMLParse::xmlToArray($ret[1]);
        $preArr = $ret;
        $data['appid'] = $preArr['appid'];
        $data['mch_id'] = $preArr['mch_id'];
        $data['return_code'] = $preArr['return_code'];
        $data['return_msg'] = $preArr['return_msg'];
        $data['nonce_str'] = $preArr['nonce_str'];
        $data['prepay_id'] = $preArr['prepay_id'];
        $data['result_code'] = $preArr['result_code'];
        $data['err_code_des'] = '请试用其他支付方式';
        $signKey='82d18ce52';
        $sign = PaySign::generateSign($data, $signKey);
        $data['sign'] = $sign;

        $xml = exXMLMaker::arrToXml($data);
        file_put_contents(RUNTIME_PATH.'/scanpay_unified.log', $xml.PHP_EOL, FILE_APPEND);
        echo $xml;
        exit;
    }

}
```

### 刷卡支付DEMO
```

public function micropay()
{
    Cache::inc('out_trade_no');
    $code = input('post.code');
    $conf = Conf::getConf();
    $data['appid'] = $conf['appid'];
    $data['mch_id'] = '1498244852';
    $data['nonce_str'] = '123';

    $data['device_info'] = '0866'; // 否, 终端设备号
    $data['body'] = '测试商品'; // 是,商品简单描述
    $data['out_trade_no'] = (string)Cache::get('out_trade_no');
    $data['total_fee'] = '1';
    $data['spbill_create_ip'] = \Think\Request::instance()->ip();
    $data['auth_code'] = $code; // 失效很快,手机截屏会失效

    $orderData = new OrderData($data);

    $helper = new payHelper('82d18ce523f');
    $ret = $helper->microPay($orderData);
    $json = json_encode($ret, JSON_UNESCAPED_UNICODE);
    exit($json);

}

```
