
# JSSDK
https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141115

# JSSDK配置 DEMO

~~~php

PHP端
/**
 * 获取到jsapi_ticket应缓存本地
 * @return [type] [description]
 * @author baiyouwen
 */
public function index()
{
    $conf = Conf::getConf();
    $jsapi_ticketArr = SdkCache::ticket();
    $jsapi_ticket = $jsapi_ticketArr['ticket'];
    $url = $this->request->url(true);
    // $url = 'http://demo.bauth.exwechat.com/index.php?s=/exwechat/Demojssdk/index';
    $class = new JSSDK();
    $nonceStr = $class->createNonceStr();
    $timestamp = time();
    $signature = $class->signature($jsapi_ticket, $nonceStr, $timestamp, $url);
    $jsApiList = $class->jsApiList();
    $this->assign('appId', $conf['appid']);
    $this->assign('timestamp', $timestamp);
    $this->assign('nonceStr', $nonceStr);
    $this->assign('signature', $signature);
    $this->assign('jsApiList', $jsApiList);
    return $this->fetch();
}
~~~

~~~html
HTML端
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
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
        jsApiList: ['onMenuShareTimeline'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
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

~~~
