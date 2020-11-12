<?php

namespace youwen\exwechat;

/**
 * 消息安全
 * Class Security
 * @package youwen\exwechat
 */
class Security
{

    /**
     * 服务端接入
     * @param $signature
     * @param $token
     * @param $timestamp
     * @param $nonce
     * @return bool
     */
    public function checkSign($signature, $token, $timestamp, $nonce)
    {
        return $signature == $this->genSign($token, $timestamp, $nonce);
    }

    public function genSign($token, $timestamp, $nonce)
    {
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $sign = sha1($tmpStr);
        return $sign;
    }

    /**
     * 接收消息签名认证
     * @param $msgSignature
     * @param $encryptMsg
     * @param $token
     * @param $timestamp
     * @param $nonce
     * @return bool
     */
    public function checkMsgSign($msgSignature, $encryptMsg, $token, $timestamp, $nonce)
    {
        return $msgSignature == $this->genMsgSign($encryptMsg, $token, $timestamp, $nonce);
    }

    public function genMsgSign($encryptMsg, $token, $timestamp, $nonce)
    {
        $array = array($encryptMsg, $token, $timestamp, $nonce);
        sort($array, SORT_STRING);
        $str = implode($array);

        return sha1($str);
    }


}