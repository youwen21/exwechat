<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * Class Message
 * @package youwen\exwechat\Request
 * @see
 */
class Message
{
    // 根据分组进行群发【订阅号与服务号认证后均可用】 POST
    const MESSAGE_SEND_ALL_URL = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=%s';

    // 根据OpenID列表群发【订阅号不可用，服务号认证后可用】 POST
    const MESSAGE_SEND_URL = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=%s';
    // 上传视频 POST (根据openid发)
    const UPLOAD_VIDEO_URL = 'https://api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=%s';

    // 删除群发【订阅号与服务号认证后均可用】 POST
    const DELETE_URL = 'https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=%s';
    // 预览接口【订阅号与服务号认证后均可用】 POST  限制（100次），请勿滥用
    const PREVIEW_URL = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=%s';
    // 查询群发消息发送状态【订阅号与服务号认证后均可用】 POST
    const GET_URL = 'https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=%s';


    public function get($accessToken, $headers = [])
    {
        $url = sprintf(self::GET_URL, $accessToken);
        return new Request('GET', $url, $headers);
    }

    public function preview($accessToken, $headers = [])
    {
        $url = sprintf(self::PREVIEW_URL, $accessToken);
        return new Request('GET', $url, $headers);
    }

    public function delete($accessToken, $headers = [])
    {
        $url = sprintf(self::DELETE_URL, $accessToken);
        return new Request('GET', $url, $headers);
    }

    public function uploadVideo($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::UPLOAD_VIDEO_URL, $accessToken);
        return new Request('GET', $url, $body, $headers);
    }

    public function messageSend($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MESSAGE_SEND_URL, $accessToken);
        return new Request('GET', $url, $body, $headers);
    }

    public function messageSendAll($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MESSAGE_SEND_ALL_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }
}
