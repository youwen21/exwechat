# exwechat
微信公众号开发库,是一个开源的库，拿去用，开源协议不太懂，不会写。

>git地址：https://github.com/youwen21/exwechat

## 项目说明

youwen/exwecaht是个人开发的项目，方便调用微信公众号接口，功能有：

+ 微信账户access_token，IP白名单接口
+ 微信用户接口
+ 用户消息收取与回复接口
+ 公众号菜单管理管理接口
+ 多媒体图片接口
+ 统计接口
+ OAuth接口
+ JSSDK接口
+ 微信支付

未开发的功能：

-  微信红包
-  微信卡券
-  等

## composer安装说明

>composer require youwen/exwechat


## 目录说明

```
vendor/youwen/exwechat  
├─api           API目录
│  ├─account             
│  ├─custom       
│  ├─JSSDK        
│  ├─media        
│  ├─menu        
│  ├─message      
│  ├─OAuth 
│  ├─user
│  └─statistics      
│  ├─AbstractApi.php
│  ├─accessToken.php
│  ├─http.php
│  └─ips.php 
│
├─sql                存放SQL文件的目录
│  └─*.sql
│
├─errorCode.php
├─errorContainer.php
├─exRequest.php
├─exResponse.php
├─exWechat.php
├─exXMLMaker.php
├─Prpcrypt.php
├─XMLParse.php
```

# DEMO && 使用教程

- [微信开发入门说明](doc/tutorial.md)
- [微信XML消息接收处理](doc/firstStep.md)
- [获取accessToken](doc/accessToken.md)
- [OAuth2.0使用DEMO](doc/oauth.md)
- [JSSDK配置](doc/jssdk_conf.md)
- [JSSDK分享到朋友圈接口DEMO](doc/jssdk_demo.md)
- [JSSDK支付接口](doc/jssdk_pay.md)
- [微信支付](doc/pay.md)

