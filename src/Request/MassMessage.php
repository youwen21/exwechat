<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 群发消息和原创校验
 * Class MassMessage
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html
 */
class MassMessage
{
    // 1 上传图文消息内的图片获取URL【订阅号与服务号认证后均可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#0
    const MEDIA_UPLOAD_IMG = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=ACCESS_TOKEN';
    // 2 上传图文消息素材【订阅号与服务号认证后均可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#1
    const MEDIA_UPLOAD_NEWS = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=ACCESS_TOKEN';
    // 3 根据标签进行群发【订阅号与服务号认证后均可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#2
    const MESSAGE_MASS_SENDALL = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=ACCESS_TOKEN';

    // 视频的media_id - 素材管理 - 新增素材
    // const MEDIA_UPLOAD_VIDEO = 'https://api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=ACCESS_TOKEN';

    // 4 根据OpenID列表群发【订阅号不可用，服务号认证后可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#3
    const MESSAGE_MASS_SEND = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=ACCESS_TOKEN';
    // 5 删除群发【订阅号与服务号认证后均可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#4
    const MESSAGE_MASS_DELETE = 'https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=ACCESS_TOKEN';
    // 6 预览接口【订阅号与服务号认证后均可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#5
    const MESSAGE_MASS_PREVIEW = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=ACCESS_TOKEN';
    // 7 查询群发消息发送状态【订阅号与服务号认证后均可用】 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#6
    const MESSAGE_MASS_GET = 'https://api.weixin.qq.com/cgi-bin/message/mass/get?access_token=ACCESS_TOKEN';
    // 8 事件推送群发结果 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#7
    // 9 使用 clientmsgid 参数，避免重复推送 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#8

    // 10 控制群发速度 https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Batch_Sends_and_Originality_Checks.html#9
    const MESSAGE_MASS_SPEED = ' https://api.weixin.qq.com/cgi-bin/message/mass/speed/get?access_token=ACCESS_TOKEN';

    /**
     * 1 上传图文消息内的图片获取URL【订阅号与服务号认证后均可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function mediaUploadImg($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MEDIA_UPLOAD_IMG);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 2 上传图文消息素材【订阅号与服务号认证后均可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function mediaUploadNews($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MEDIA_UPLOAD_NEWS);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 3 根据标签进行群发【订阅号与服务号认证后均可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageMassSendAll($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_MASS_SENDALL);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 4 根据OpenID列表群发【订阅号不可用，服务号认证后可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageMassSend($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_MASS_SEND);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 5 删除群发【订阅号与服务号认证后均可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageMassDelete($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_MASS_DELETE);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 6 预览接口【订阅号与服务号认证后均可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageMassPreview($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_MASS_PREVIEW);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 7 查询群发消息发送状态【订阅号与服务号认证后均可用】
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageMassGet($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_MASS_GET);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 10 控制群发速度
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function messageMassSpeed($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MESSAGE_MASS_SPEED);
        return new Request('POST', $url, $body, $headers);
    }
}