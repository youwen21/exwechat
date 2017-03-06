<?php
namespace youwen\exwechat;

class exWechat
{
    
    private $_token = 'bjnqCQ1440899050';
    public function __construct($token='')
    {
        if (!empty($token)) {
            $this->_token = $token;
        }
    }

    /**
     * 验证
     */
    public function authentication()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $tmpArr = array($this->_token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $sign = sha1($tmpStr);
        if ($sign == $signature) {
            if(isset($_GET['echostr'])){
                return $_GET['echostr'];
            }
            return true;
        }
        return false;
    }

    /**
     * 验证消息是否来自微信服务器
     * 验证消息签名字符患是否正确
     * @return [type] [description]
     * @author baiyouwen
     */
    public function check($encrypt_msg)
    {

        $array = array($encrypt_msg, $this->_token, $_GET['timestamp'], $_GET['nonce']);
        sort($array, SORT_STRING);
        $str = implode($array);

        if($_GET['msg_signature'] == sha1($str)){
            return true;
        }
        return false;
    }
}
