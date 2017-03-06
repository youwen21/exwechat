<?php
namespace youwen\exwechat;

use youwen\exwechat\Prpcrypt;
use youwen\exwechat\XMLParse;

/**
 * 微信消息控制器 － 单例模式
 * 保存发来的XML微信消息
 * xml转成的数组消息
 * 消息验证是否来自微信
 */
class exRequest
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    public $originalMsg; // 原生XML消息
    public $msg; // 数组消息

    private $encodingAesKey='';
    private $appId='';
    private $token='';

    public $errorCode = 0;
    public $errorMsg = '';

    /**
     * 微信消息实例
     * 微信消息XML解析成数组
     * @param  int $encryptType [1文明 ，2 兼容 ， 3加密]
     * @author baiyouwen
     */
    protected function __construct($encryptType, $msgCheck, $param)
    {
        // 初始化配置
        if(!empty($param)){
            foreach ($param as $key => $value) {
                if(in_array($key, ['encodingAesKey', 'appId', 'token'])){
                    $this->{$key} = $value;
                }
            }
        }
        // 获取微信服务器推送来的消息
        $this->originalMsg = file_get_contents("php://input");
        if(empty($this->originalMsg)){
            $this->errorCode='001';
            $this->errorMsg='非正常请求';
            return;
        }
        // XML消息解析成数组
        $data = XMLParse::xmlToArray($this->originalMsg);
        //提取密文
        // $xmlparse = new XMLParse;
        // $array = $xmlparse->extract($this->originalMsg);

        // 消息传输类型判断（明文｜兼容｜加密）
        switch ($encryptType) {
            case '1': // 明文
                $this->msg = $data;
                break;
            case '2': // 兼容
                // if($msgCheck){
                //     if(!$this->_check($data['Encrypt'])){
                //         $this->errorCode=203;
                //         $this->errorMsg='消息签名验证失败';
                //         break;
                //     }
                // }
                if(isset($data['Encrypt'])) unset($data['Encrypt']);
                $this->msg = $data;
                break;
            case '3': // 密文
                if($msgCheck){
                    if(!$this->_check($data['Encrypt'])){
                        $this->errorCode=303;
                        $this->errorMsg='消息签名验证失败';
                        break;
                    }
                }
                $result = $this->_decryptMsg($data['Encrypt']);
                if(!$result[0]){
                    $this->msg = XMLParse::xmlToArray($result[1]);
                }
                break;
            default:
                # code...
                break;
        }
    }

    public static function instance($encryptType = 1, $msgCheck=false, $param=[])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($encryptType, $msgCheck, $param);
        }
        return self::$instance;
    }

    /**
     * 解密消息
     * @param  string $encrypt 加密的消息体
     * @return array          解密状态和解密结果
     * @author baiyouwen
     */
    private function _decryptMsg($encrypt='')
    {
        if (strlen($this->encodingAesKey) != 43) {
            exit('AesKey不正确');
        }
        $pc = new Prpcrypt($this->encodingAesKey);
        return $pc->decrypt($encrypt, $this->appId);
    }

    /**
     * 验证消息是否来自微信服务器
     * 验证消息签名字符患是否正确
     * @return [type] [description]
     * @author baiyouwen
     */
    private function _check($encrypt_msg)
    {
        $array = array($encrypt_msg, $this->token, $_GET['timestamp'], $_GET['nonce']);
        sort($array, SORT_STRING);
        $str = implode($array);
        if($_GET['msg_signature'] == sha1($str)){
            return true;
        }
        return false;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function getOriginalMsg()
    {
        return $this->originalMsg;
    }

    public function getFromUserName()
    {
        return $this->msg['FromUserName'];
    }
}

