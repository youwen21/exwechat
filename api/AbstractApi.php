<?php
namespace youwen\exwechat\api;

/**
 * 抽象类Api约定子类
 * @author baiyouwen <youwen21@yeah.net>
 */
abstract class AbstractApi
{
    public $errorCode = 0;
    public $errorMsg = '';

    public $originalData; // 原生消息
    public $data; // 数组消息

    // 强制要求子类定义这些方法
    // abstract public function auth();

    public function commenPart($ret)
    {
        if(!$ret[0]){ // 正确执行
            $this->originalData = $ret[1];
            $this->data = json_decode($ret[1], true);
            return $this->data;
        }else{ // 有错误码
            $this->errorCode = 0;
            $this->errorMsg = '';
        }
        return false;
    }
}
