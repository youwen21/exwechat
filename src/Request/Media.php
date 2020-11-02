<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 素材管理
 * Class Media
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/Asset_Management/New_temporary_materials.html
 */
class Media
{
    const MEDIA_UPLOAD = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type=TYPE";
    const MEDIA_GET = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID";

    const MATERIAL_ADD_NEWS = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=ACCESS_TOKEN";
    const MATERIAL_GET = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=ACCESS_TOKEN";
    const MATERIAL_DEL = "https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=ACCESS_TOKEN";
    const MATERIAL_UPDATE_NEWS = "https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=ACCESS_TOKEN";
    const MATERIAL_GET_AMOUNT = "https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=ACCESS_TOKEN";
    const MATERIAL_BATCH_GET = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN";
//    // 上传图文消息内的图片获取URL【订阅号与服务号认证后均可用】 POST
//    const MEDIA_UPLOAD_IMG_URL = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=%s';
//    // 上传图文消息素材【订阅号与服务号认证后均可用】 POST
//    const MEDIA_UPLOAD_NEWS_URL = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=%s';
//    // 上传视频 POST (群发)
//    const MEDIA_UPLOAD_VIDEO_URL = 'https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=%s';

    /**
     * 新增临时素材
     * type: image, voice, video, thumb
     * @param $accessToken
     * @param $type
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function mediaUpload($accessToken, $type, $body, $headers = [])
    {
        $url = sprintf(self::MEDIA_UPLOAD, $accessToken, $type);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 获取临时素材
     * @param $accessToken
     * @param $mediaId
     * @param array $headers
     * @return Request
     */
    public function mediaGet($accessToken, $mediaId, $headers = [])
    {
        $url = sprintf(self::MEDIA_GET, $accessToken, $mediaId);
        return new Request('POST', $url, $headers);
    }

    /**
     * 新增永久素材 - 新增永久图文素材
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function materialAddNews($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MATERIAL_ADD_NEWS, $accessToken);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 获取永久素材
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function materialGet($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MATERIAL_GET, $accessToken);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 删除永久图片素材
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function materialDel($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MATERIAL_GET, $accessToken);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 修改永久图片素材
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function materialUpdateNews($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MATERIAL_UPDATE_NEWS, $accessToken);
        return new Request('POST', $url, $body, $headers);
    }

    /**
     * 获取素材总数
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function materialGetAmount($accessToken, $headers = [])
    {
        $url = sprintf(self::MATERIAL_UPDATE_NEWS, $accessToken);
        return new Request('GET', $url, $headers);
    }

    /**
     * 获取素材列表 - 批量以分页式获取素材
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function materialBatchGet($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MATERIAL_BATCH_GET, $accessToken);
        return new Request('POST', $url, $body, $headers);
    }

//    public function mediaUploadVideo($accessToken, $body, $headers = [])
//    {
//        $url = sprintf(self::MEDIA_UPLOAD_VIDEO_URL, $accessToken);
//        return new Request('POST', $url, $body, $headers);
//    }
//
//    public function mediaUploadNews($accessToken, $body, $headers = [])
//    {
//        $url = sprintf(self::MEDIA_UPLOAD_NEWS_URL, $accessToken);
//        return new Request('POST', $url, $body, $headers);
//    }
//
//    public function mediaUploadImg($accessToken, $body, $headers = [])
//    {
//        $url = sprintf(self::MEDIA_UPLOAD_IMG_URL, $accessToken);
//        return new Request('POST', $url, $body, $headers);
//    }
}
