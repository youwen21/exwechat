
# 微信公众号支付
https://pay.weixin.qq.com/wiki/doc/api/jsapi.php?chapter=7_1

# DEMO
HTML端  
~~~html
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JSSDK pay</title>

    <!-- Bootstrap -->
    <link href="{:config('__public__')}/static/bootstrap-3.3.4/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<style type="text/css">
  .rowTitle{
    line-height: 30px;
  }
</style>
      <h3 class="text-center bg-success" style="line-height: 40px">微信JS-SDK</h3>

    <div class="container">

      <div class="row">
        <h4 class="text-center bg-primary rowTitle"> JSSDK demo </h4>
        <p class="text-center">微信公众号支付</p>
        
        <div class="col-lg-4">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">这是一个商品</h3>
            </div>
            <div class="panel-body">
              <p style="WORD-BREAK: break-all; WORD-WRAP: break-word"></p>
              <p>发起支付 <a href="javascript:paynow();">去微信支付</a></p>
              <p>&nbsp;</p>
            </div>
          </div>
        </div>
      </div>
      

    </div>
  </body>
  <script src="{:config('__public__')}/static/jquery-2.0.3.min.js"></script>

  <script type="text/javascript">
    function paynow(){
      $.ajax({
        url:"{$expay}",
        type:'POST',
        data:'',
        dataType: "json",
        success:function(res){
          mypay(res);
        },
        error:function(err){

        }
      })
    }

    function mypay(res)
    {
      // alert(typeof res)
      // obj =  res.parseJSON(); 
      obj = eval('(' + res + ')');
      wx.chooseWXPay({
        appId : obj.appId,
        nonceStr : obj.nonceStr,
        package : obj.package,
        signType : obj.signType,
        timestamp : obj.timeStamp,
        paySign : obj.paySign,
        success: function (ret) {
        // 支付成功后的回调函数
        },
        error: function(err){
          alert($err)
        }
      });
    }
    function pay(){
      wx.chooseWXPay({
        appId : "",
        nonceStr: "", // 支付签名随机串，不长于 32 位
        package: "", // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=\*\*\*）
        signType: '', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
        timestamp: "", // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
        paySign: "", // 支付签名
        success: function (res) {
        // 支付成功后的回调函数
        },
        error: function(err){
          alert($err)
        }
      });
    }
  </script>

  <script type="text/javascript">
    // 步骤三：通过config接口注入权限验证配置
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: "{$appId}", // 必填，公众号的唯一标识
        timestamp: "{$timestamp}", // 必填，生成签名的时间戳
        nonceStr: "{$nonceStr}", // 必填，生成签名的随机串
        signature: "{$signature}",// 必填，签名，见附录1
        jsApiList: [{$jsApiList}] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        // jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    // 步骤四：通过ready接口处理成功验证
    wx.ready(function(){
      // 判断当前客户端版本是否支持指定JS接口
      wx.checkJsApi({
          jsApiList: ['chooseWXPay'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
          success: function(res) {
              // 以键值对的形式返回，可用的api值true，不可用为false
              // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
          }
      });

        // wx.hideMenuItems({
        //     menuList: [ "menuItem:share:appMessage",  "menuItem:share:timeline", "menuItem:share:qq", "menuItem:share:weiboApp",  "menuItem:favorite",  "menuItem:share:facebook", "menuItem:share:QZone"] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
        // });
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
    });
    // 步骤五：通过error接口处理失败验证
    wx.error(function(res){
    // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
    });


  </script>
</html>
~~~

PHP端  
```php

/**
 * 在product页面 调用此接口实现统一下单
 * @return [type] [description]
 * @author baiyouwen
 */
public function expay()
{
    //if(empty(Session::get('openid'))){
    //    exit('lost openid');
    //}
    $signValue = '82d18ce523';
    
    $pay = new pay($signValue);

    $conf = Conf::getConf();
    //必要参数
    // 需要接口传过来的有4个
    $wxConf['body'] = '测试商品'; //商品(订单)描述
    $wxConf['out_trade_no'] = '129'; //从123开始，唯一订单号
    $wxConf['total_fee'] = '1'; // 订单总金额
    $wxConf['spbill_create_ip'] = \Think\Request::instance()->ip();

    $wxConf['openid'] = 'oLlT-1CSztIM8hTv70spCGhhQtzc';
    $wxConf['appid'] = $conf['appid'];
    $wxConf['mch_id'] = '1498244852';
    $wxConf['notify_url'] = url('paynotify','', true, true);
    $wxConf['trade_type'] = 'JSAPI'; // 交易类型

    $wxConf['nonce_str'] = '123456789';


    // 非必要
    // $wxConf['product_id'] = '';
    // $wxConf['detail'] = '';
    // $wxConf['attach'] = '';
    // $wxConf['fee_type'] = '';
    // $wxConf['sign_type'] = '';

    $input = new UnifiedOrder($wxConf);
    $ret = $pay->unifiedOrder($input);
    if($ret[0]){ // 正常CURL
        $arr = XMLParse::xmlToArray($ret[1]);
        return json_encode($arr, JSON_UNESCAPED_UNICODE );
    }else{
        $arr = XMLParse::xmlToArray($ret[1]);
        $wxpay = $this->initChooseWXPay($arr['prepay_id']);
        return $wxpay;
    }
}
```

PHP端使用payHelper可以简化开发
~~~php
public function testpay()
{
    // 参数准备
    $conf = Conf::getConf();
    //必要参数
    // 需要接口传过来的有4个
    $wxConf['body'] = '测试商品'; //商品(订单)描述
    $wxConf['out_trade_no'] = '120'; //从123开始，唯一订单号
    $wxConf['total_fee'] = '1'; // 订单总金额
    $wxConf['spbill_create_ip'] = \Think\Request::instance()->ip();

    $wxConf['openid'] = 'oLlT-1CSztIM8hTv70spCGhhQtzc';
    $wxConf['appid'] = $conf['appid'];
    $wxConf['mch_id'] = '1498244852';
    $wxConf['notify_url'] = url('paynotify','', true, true);
    $wxConf['trade_type'] = 'JSAPI'; // 交易类型
    $wxConf['nonce_str'] = '123456789';
    $input = new UnifiedOrder($wxConf);
    
    $signValue = '82d18ce5';
    
    // monolog , 日志类准备
    $log = new Logger('pay');
    $log->pushHandler(new StreamHandler(RUNTIME_PATH.'/exwechat/pay.log', Logger::DEBUG));

    // 使用payHelper
    $payHelper = new payHelper($signValue);
    $payHelper->setDebug(1);
    $payHelper->setLogger($log);
    $ret = $payHelper->unified($input);
    echo '<pre>';
    print_r( $ret );
    exit('</pre>');
}
~~~

