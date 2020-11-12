<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 一次性订阅消息 - 用户可以在不关注公众号的情况下获得一次消息
 * Class SubscribeMsg
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/One-time_subscription_info.html
 */
class SubscribeMsg
{
    // 第一步：需要用户同意授权，获取一次给用户推送一条订阅模板消息的机会
    const SUBSCRIBE_MSG = 'https://mp.weixin.qq.com/mp/subscribemsg?action=get_confirm&appid=%s&scene=%s&template_id=%s&redirect_url=%s&reserved=%s#wechat_redirect';

    // 第二步：通过API推送订阅模板消息给到授权微信用户
    const TEMPLATE_SUBSCRIBE = 'https://api.weixin.qq.com/cgi-bin/message/template/subscribe?access_token=ACCESS_TOKEN';

    /**
     * 第一步：需要用户同意授权，获取一次给用户推送一条订阅模板消息的机会
     * @param $appId
     * @param $scene
     * @param $templateId
     * @param $redirectUrl
     * @param $reserved
     * @return string
     */
    public function getSubscribeMsgUrl($appId, $scene, $templateId, $redirectUrl, $reserved)
    {
        $url = sprintf(self::SUBSCRIBE_MSG, $appId, $scene, $templateId, $redirectUrl, $reserved);
        return $url;
    }

    /**
     * 第二步：通过API推送订阅模板消息给到授权微信用户
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function templateSubscribe($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::TEMPLATE_SUBSCRIBE);
        return new Request('POST', $url, $headers, $body);
    }
}
