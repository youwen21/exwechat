<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * Class Menu
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Custom_Menus/Creating_Custom-Defined_Menu.html
 */
class Menu
{
    const MENU_GET_URL = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=%s';
    const MENU_CREATE = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s';
    const MENU_DELETE = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=%s';
    const MENU_ADD_CONDITIONAL = 'https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=%s';
    const MENU_INFO = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=%s';


    /**
     * 创建接口
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function menuCreate($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MENU_CREATE, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 查询接口
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function menuInfo($accessToken, $headers = [])
    {
        $url = sprintf(self::MENU_INFO, $accessToken);
        return new Request('GET', $url, $headers);
    }

    /**
     * 删除接口
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function menuDelete($accessToken, $headers = [])
    {
        $url = sprintf(self::MENU_DELETE, $accessToken);
        return new Request('GET', $url, $headers);
    }

    /**
     * 个性化菜单接口
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function menuAddConditional($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MENU_ADD_CONDITIONAL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 获取自定义菜单配置
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function menuGet($accessToken, $headers = [])
    {
        $url = sprintf(self::MENU_GET_URL, $accessToken);
        return new Request('GET', $url, $headers);
    }
}
