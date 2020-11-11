<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 帐号管理
 * Class Account
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Account_Management/Generating_a_Parametric_QR_Code.html
 */
class Account
{
    // 临时二维码请求说明, 永久二维码请求说明
    const QRCODE_CREATE = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN';

    // 通过ticket换取二维码
    const SHOW_QRCODE = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=TICKET';

    // 长链接转短链接接口
    const SHORT_URL = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token=ACCESS_TOKEN';

    /**
     * 临时二维码请求说明
     * 永久二维码请求说明
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function qrCodeCreate($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::QRCODE_CREATE);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 通过ticket换取二维码
     * @param $ticket
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function showQrCode($ticket, $body, $headers = [])
    {
        $url = str_replace('TICKET', $ticket, self::SHOW_QRCODE);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 长链接转成短链接
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function shortUrl($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::SHORT_URL);
        return new Request('POST', $url, $body, $headers);
    }
}