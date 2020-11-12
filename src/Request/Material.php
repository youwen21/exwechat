<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 图片消息留言管理
 * Class Material
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Comments_management/Image_Comments_Management_Interface.html
 */
class Material
{

    const MATERIAL_ADD_NEWS = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=ACCESS_TOKEN';

    const MATERIAL_GET = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=ACCESS_TOKEN';

    const MATERIAL_UPDATE_NEWS = 'https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=ACCESS_TOKEN';

    const MATERIAL_BATCH_GET = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN';

    const COMMENT_OPEN = 'https://api.weixin.qq.com/cgi-bin/comment/open?access_token=ACCESS_TOKEN';

    const COMMENT_CLOSE = 'https://api.weixin.qq.com/cgi-bin/comment/close?access_token=ACCESS_TOKEN';

    const COMMENT_LIST = 'https://api.weixin.qq.com/cgi-bin/comment/list?access_token=ACCESS_TOKEN';

    const COMMENT_MARKELECT = 'https://api.weixin.qq.com/cgi-bin/comment/markelect?access_token=ACCESS_TOKEN';

    const COMMENT_UNMARKELECT = 'https://api.weixin.qq.com/cgi-bin/comment/unmarkelect?access_token=ACCESS_TOKEN';

    const COMMENT_DELETE = 'https://api.weixin.qq.com/cgi-bin/comment/delete?access_token=ACCESS_TOKEN';

    const COMMENT_REPLY = 'https://api.weixin.qq.com/cgi-bin/comment/reply/add?access_token=ACCESS_TOKEN';

    const COMMENT_REPLY_DELETE = 'https://api.weixin.qq.com/cgi-bin/comment/reply/delete?access_token=ACCESS_TOKEN';


    /**
     * 1.1 新增永久素材（原接口有所改动）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function addNews($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MATERIAL_ADD_NEWS);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 1.2 获取永久素材（原接口有所改动）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function getMaterial($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MATERIAL_GET);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 1.3 修改永久图文素材（原接口有所改动）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function updateNews($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MATERIAL_UPDATE_NEWS);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 1.4 获取素材列表（原接口有所改动）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function batchGetMaterial($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::MATERIAL_BATCH_GET);
        return new Request('POST', $url, $headers, $body);
    }


    /**
     * 2.1 打开已群发文章评论（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentOpen($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_OPEN);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.2 关闭已群发文章评论（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentClose($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_CLOSE);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.3 查看指定文章的评论数据（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentList($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_LIST);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.4 将评论标记精选（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentMarkElect($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_MARKELECT);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.5 将评论取消精选
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentUnMarkElect($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_UNMARKELECT);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.6 删除评论（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentDelete($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_DELETE);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.7 回复评论（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentReply($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_DELETE);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 2.8 删除回复（新增接口）
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function commentReplyDelete($accessToken, $body, $headers = [])
    {
        $url = str_replace('ACCESS_TOKEN', $accessToken, self::COMMENT_DELETE);
        return new Request('POST', $url, $headers, $body);
    }
}