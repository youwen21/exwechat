<?php
namespace youwen\exwechat\api\account;

use youwen\exwechat\api\AbstractApi;
use youwen\exwechat\api\http;
/**
 * 获取微信用户
 * @author baiyouwen <youwen21@yeah.net>
 * @license https://mp.weixin.qq.com/wiki 账户管理－生成带参数二维码
 *
 * expire_seconds 最大不超过2592000（即30天），默认有效期为30秒。
 * action_name 类型，QR_SCENE为临时,QR_LIMIT_SCENE为永久,QR_LIMIT_STR_SCENE为永久的字符串参数值
 * action_info 二维码详细信息
 * scene_id 场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
 * scene_str 场景值ID（字符串形式的ID），字符串类型，长度限制为1到64，仅永久二维码支持此字段   
 */
class QRCode extends AbstractApi
{
    private $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s';
    private $urlQRshow = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s';


    private $token;
    public function __construct($token='')
    {
        $this->token = $token;
    }

    /**
     * 生成永久二维码
     * @param  string $action_name 类型[QR_LIMIT_SCENE|QR_LIMIT_STR_SCENE]
     * @param  [type] $scene       [description]
     * @return [type]              [description]
     * @author baiyouwen
     */
    public function permanentQR($action_name, $scene)
    {
        $param = [];
        $param['action_name'] = $action_name;
        switch ($action_name) {
            case 'QR_LIMIT_SCENE':
                $param['action_info']['scene']['scene_id'] = $scene;
                break;
            case 'QR_LIMIT_STR_SCENE':
                $param['action_info']['scene']['scene_str'] = $scene;
                break;
            default:
                # code...
                break;
        }
        return $this->createQR($param);
    }

    // 临时二维码
    public function temporaryQR($scene_id, $expire_seconds=604800)
    {
        $param = [];
        $param['action_name'] = 'QR_SCENE';
        $param['expire_seconds'] = $expire_seconds;
        $param['action_info']['scene']['scene_id'] = $scene_id;
        return $this->createQR($param);
    }

    public function createQR($data)
    {
        $url = sprintf($this->url, $this->token);
        $json = is_array($data)? json_encode($data) : $data;
        $ret = http::curl_post($url, $json);
        if(!$ret[0]){ // 正确执行
            $this->originalData = $ret[1];
            $this->data = json_decode($this->originalData, true);
        }else{ // 有错误码
            $this->errorCode = 0;
            $this->errorMsg = '';
        }
        return $this->data;
    }

    public function QRshow($ticket)
    {
        return sprintf($this->urlQRshow, $ticket);
    }
}
