<?php
namespace youwen\exwechat\api\media;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;

/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 * @license [https://mp.weixin.qq.com/wiki]
 */
class media extends AbstractApi
{
    // 新增临时图文素材 上传多媒体文件 POST/FORM
    private $urlMediaUpload = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s';
    // 获取临时素材 下载多媒体文件
    private $urlMediaGet = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=%s&media_id=%s';
    // 新增永久图文素材
    private $urlMediaNews = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=%s';
    // 上传图文消息内的图片获取URL
    // 本接口所上传的图片不占用公众号的素材库中图片数量的5000个的限制。图片仅支持jpg/png格式，大小必须在1MB以下
    private $urluploadimg = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=%s';
    // 新增其他类型永久素材
    private $urlAddMaterial = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=%s';
    // 获取永久素材
    private $urlGetMaterial ='https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=%s';
    // 删除永久素材
    private $urlDelMaterial ='https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=%s';
    // 修改永久图文素材
    private $url2 ='https://api.weixin.qq.com/cgi-bin/material/update_news?access_token=%s';
    // 获取永久素材总数
    private $urlmaterialcount ='https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=%s';
    // 获取永久素材列表
    private $urlmaterial ='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=%s';

    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    /**
     * temp = temporary 临时
     * 新增临时图文素材
     * @param  string $data [description]
     * @param  string $type [分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）]
     * @return [type]       [description]
     * @author baiyouwen
     * 目前只支持图片
     */
    public function tempUpload($media_path='', $type='image')
    {
        $url = sprintf($this->urlMediaUpload, $this->token, $type);
        $file = str_replace("\\", "/", realpath($media_path));
        $data = array();
        // $data['type'] = $type;
        $data['media'] = new \CURLFile($file); // php5.5后。  php5.5前用 '@'.$file;
        $ret = http::curl_post($url, $data);
        return $this->commenPart($ret);
    }

    /** 
     * 获取临时素材 - 下载功能
     * @param  string $value [description]
     * @return [type]        [description]
     * @author baiyouwen
     */
    public function tempGet($media_id='')
    {
        $url = sprintf($this->urlMediaGet, $this->token, $media_id);
        $ret = http::curl_get($url);
        // 保存处理  此ret为图片
        return $ret;
    }

    /**
     * 新增永久图文素材
     * @author baiyouwen
     */
    public function add_news()
    {

    }
    /**
     * 修改永久图文素材
     * @author baiyouwen
     */
    public function update_news()
    {
        
    }

    /**
     * 新增永久素材
     * @param  string $media_path [文件路径]
     * @param  string $type       [分别有图片（image）、语音（voice）、视频（video）和缩略图（thumb）]
     * @author baiyouwen
     * 目前只支持图片
     */
    public function add_material($media_path='', $type='image')
    {
        $url = sprintf($this->urlAddMaterial, $this->token);
        $file = str_replace("\\", "/", realpath($media_path));
        $data = array();
        $data['type'] = $type;
        $data['media'] = new \CURLFile($file); // php5.5后。  php5.5前用 '@'.$file;
        $ret = http::curl_post($url, $data);
        return $this->commenPart($ret);
    }
    /**
     * 获取永久素材  － 下载素材
     * @author baiyouwen
     */
    public function get_material($media_id='')
    {
        $url = sprintf($this->urlGetMaterial, $this->token);
        $json = json_encode(['media_id'=>$media_id]);
        $ret = http::curl_post($url, $json);
        // 保存处理  此ret为图片
        return $ret;
    }
    /**
     * 删除永久素材
     * @author baiyouwen
     */
    public function del_material($media_id='')
    {
        $url = sprintf($this->urlDelMaterial, $this->token);
        $json = json_encode(['media_id'=>$media_id]);
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }

    /**
     * 获取永久素材总数
     * @author baiyouwen
     */
    public function get_materialcount()
    {
        $url = sprintf($this->urlmaterialcount, $this->token);
        $ret = http::curl_get($url);
        return $this->commenPart($ret);
    }

    /**
     * 获取永久素材列表
     * @param  string  $type   [图片（image）、视频（video）、语音 （voice）、图文（news）]
     * @param  integer $offset [从全部素材的该偏移位置开始返回，0表示从第一个素材 返回]
     * @param  integer $count  [返回素材的数量，取值在1到20之间]
     * @return [type]          [description]
     * @author baiyouwen
     */
    public function batchget_material($type='image', $offset=0, $count=20)
    {
        $url = sprintf($this->urlmaterial, $this->token);
        $data['type'] = $type;
        $data['offset'] = $offset;
        $data['count'] = $count;
        $json = json_encode($data);
        $ret = http::curl_post($url, $json);
        return $this->commenPart($ret);
    }
}
