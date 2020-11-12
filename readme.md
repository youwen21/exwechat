# exwechat是一个微信公众号开发包

# 重要组成
- Config 微信公众号配置管理
- Cache  实现Psr\SimpleCache\CacheInterface PSR协议的缓存包
- TokenManager 依赖Config和Cache， 从微信api获得access_token，缓存它。
- ApiClient， 包装GuzzleHttp/Client
- requests, 每一个request都对应微信公众号的API

TokenManager 和 ApiClient是最重要的两个类。  
TokenManager 调度cache缓存access_token。 另外从微信公众号获得access_token。  
ApiClient 包装GuzzleHttp/Client, xmlProcessor, jsonProcessor三个类。
一部分调用微信公众号接口，另一部分是处理response返回的xml和json内容为array数组。


# 如何记录接口请求日志
guzzle http middleware 可以设置中间件，通过中间件记录日志  
推荐:
> https://github.com/gmponos/guzzle-log-middleware

> https://github.com/namshi/cuzzle

# 已集成的api接口列表
下列表写（否）的接口代码不是微信提供的api接口，而是微信请求我方服务器接口。需要我方根据自身业务进行开发。

 - 开始开发
    + [获取access_token](https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_access_token.html)
    + [获取微信服务器IP地址](https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Get_the_WeChat_server_IP_address.html)
 - 自定义菜单
    + [创建接口](https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Creating_Custom-Defined_Menu.html)
    + [查询接口](https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Querying_Custom_Menus.html)
    + [删除接口](https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Deleting_Custom-Defined_Menu.html)
    + [事件推送（否）](https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Custom_Menu_Push_Events.html)
    + [个性化菜单接口](https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Personalized_menu_interface.html)
    + [获取自定义菜单配置](https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Getting_Custom_Menu_Configurations.html)
 - 消息管理
    + [接收普通消息（否）](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Receiving_standard_messages.html)
    + [接收事件消息（否）](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Receiving_event_pushes.html)
    + [被动回复用户消息 （否）](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Passive_user_reply_message.html)
    + [消息加密解密说明](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Message_encryption_and_decryption_instructions.html)
    + [客服消息](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Service_Center_messages.html)
    + [群发接口和原创校验](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html)
    + [模板消息接口](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Template_Message_Interface.html)
    + [一次性订阅消息](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/One-time_subscription_info.html)
 - 微信网页开发
    + [网页授权](https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/Wechat_webpage_authorization.html)
    + [JS-SDK说明文档（否）](https://developers.weixin.qq.com/doc/offiaccount/OA_Web_Apps/JS-SDK.html)
 - 素材管理
    + [新增临时素材](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/New_temporary_materials.html)
    + [获取临时素材](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Get_temporary_materials.html)
    + [新增永久素材](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Adding_Permanent_Assets.html)
    + [获取永久素材](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Getting_Permanent_Assets.html)
    + [删除永久素材](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Deleting_Permanent_Assets.html)
    + [修改永久图片素材](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Editing_Permanent_Rich_Media_Assets.html)
    + [获取素材总数](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Get_the_total_of_all_materials.html)
    + [获取素材列表](https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/Get_materials_list.html)
 - 图文消息留言管理 （下列子项在同一页面中）
    + [1.1 新增永久素材（原接口有所改动）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [1.2 获取永久素材（原接口有所改动）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [1.3 修改永久图文素材（原接口有所改动）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [1.4 获取素材列表（原接口有所改动）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.1 打开已群发文章评论（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.2 关闭已群发文章评论（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.3 查看指定文章的评论数据（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.4 将评论标记精选（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.5 将评论取消精选](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.6 删除评论（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.7 回复评论（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
    + [2.8 删除回复（新增接口）](https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html)
 - 用户管理
    + [用户标签管理](https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html)
    + [设置用户备注名](https://developers.weixin.qq.com/doc/offiaccount/User_Management/Configuring_user_notes.html)
    + [获取用户基本信息(UnionID机制)](https://developers.weixin.qq.com/doc/offiaccount/User_Management/Get_users_basic_information_UnionID.html#UinonId)
    + [获取用户列表](https://developers.weixin.qq.com/doc/offiaccount/User_Management/Getting_a_User_List.html)
    + [获取用户地理位置（否）](https://developers.weixin.qq.com/doc/offiaccount/User_Management/Gets_a_users_location.html)
    + [黑名单管理](https://developers.weixin.qq.com/doc/offiaccount/User_Management/Manage_blacklist.html)
        - 1. 获取公众号的黑名单列表
        - 2. 拉黑用户
        - 3. 取消拉黑用户
 - 帐号管理
    + [生成带参数二维码](https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Generating_a_Parametric_QR_Code.html)
    + [长链接转短链接接口](https://developers.weixin.qq.com/doc/offiaccount/Account_Management/URL_Shortener.html)
    + [微信认证事件推送](https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Wechat_Accreditation_Event_Push.html)
 - 数据统计
    + [用户分析](https://developers.weixin.qq.com/doc/offiaccount/Analytics/User_Analysis_Data_Interface.html)
        - 获取用户增减数据（getusersummary）
        - 获取累计用户数据（getusercumulate）
    + [图文分析](https://developers.weixin.qq.com/doc/offiaccount/Analytics/Graphic_Analysis_Data_Interface.html)
        - 获取图文群发每日数据（getarticlesummary）
        - 获取图文群发总数据（getarticletotal）
        - 获取图文统计数据（getuserread）
        - 获取图文统计分时数据（getuserreadhour）
        - 获取图文分享转发数据（getusershare）
        - 获取图文分享转发分时数据（getusersharehour）
    + [消息分析](https://developers.weixin.qq.com/doc/offiaccount/Analytics/Message_analysis_data_interface.html)
        - 获取消息发送概况数据（getupstreammsg）
        - 获取消息分送分时数据（getupstreammsghour）
        - 获取消息发送周数据（getupstreammsgweek）
        - 获取消息发送月数据（getupstreammsgmonth）
        - 获取消息发送分布数据（getupstreammsgdist）
        - 获取消息发送分布周数据（getupstreammsgdistweek）
        - 获取消息发送分布月数据（getupstreammsgdistmonth）
    + [广告分析](https://developers.weixin.qq.com/doc/offiaccount/Analytics/Ad_Analysis.html)
        - 获取公众号分广告位数据 publisher_adpos_general
        - 获取公众号返佣商品数据 publisher_cps_general
        - 获取公众号结算收入数据及结算主体信息 publisher_settlement
    + [接口分析](https://developers.weixin.qq.com/doc/offiaccount/Analytics/Analytics_API.html)
        - 获取接口分析数据（getinterfacesummary）
        - 获取接口分析分时数据（getinterfacesummaryhour）

# 需自行开发功能列表
    - 微信卡券
    - 微信门店
    - 微信小店
    - 智能接口
    - 微信设备功能
    - 新版客服功能
    - 对话能力（原导购助手）
    - 微信“一物一码”
    - 微信发票
    - 微信非税缴费

# DEMO1
```php
$redis = RedisFactory::create();
$redisCache = new RedisCache($redis);
$config = [
    'app_id' => '',
    'secret' => '',
    'redirect_uri' => '',
];

$tokenManager = new TokenManager($config, $redisCache);
$token = $tokenManager->getAccessToken();
$api = new ApiClient();

$ipRequest = (new Ips)->getIps($token);
$response = $api->send($ipRequest);
```

# DEMO2 使用facade
```php
// facade
$redis = RedisFactory::create();
$redisCache = new RedisCache($redis);
$config = [
    'app_id' => '',
    'secret' => '',
    'redirect_uri' => '',
];

$tokenManager = new TokenManager($config, $redisCache);
$token = $tokenManager->getAccessToken();
$api = new ApiClient();

$facade = new WechatFacade($tokenManager, $api);

$ips = $facade->getIps();
```
