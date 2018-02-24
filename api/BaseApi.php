<?php

namespace youwen\exwechat\api;

/**
 * API基类,提共部分公共方法
 * 魔术方法__call统一调用对应名称的URL,无需单独处理的接口
 * @author baiyouwen <youwen21@yeah.net>
 */
class BaseApi
{
    public $errorCode = 0;
    public $errorMsg = '';

    public $originalData; // 原生消息
    public $data; // 数组消息

    public $debug = false;
    public $logger;

    public function setDebug($boolval=false)
    {
        $this->debug = $boolval;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function HandleRet($ret)
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

    public function __get($key)
    {
        return isset($this->key)? $this->key : false;
    }

    public function __set($key, $value)
    {
        $this->key = $value;
    }

    /**
     * 方法名与URL名字相同,调用方法既可找到对应的URL
     * 
     * 不需要证书,不需要特殊化处理的接口
     * 调用方法(不存在时,找到对应的URL,把data CRUL_POST过去)
     * 需要特殊处理的接口自己定义就可以了.
     *
     * alias是为了兼容之前写的方法名与URL地址不对应
     * alias也可以缩短方法名,方便开发
     * 
     * @param  [string] $name      [调用的方法]
     * @param  [type] $arguments [description]
     * @return [type]            [description]
     * @author baiyouwen
     */
    public function __call($name, $arg)
    {
        try{
            $url = $this->{$name};
            if(isset($this->alias) && isset($this->alias[$name])){
                $urlName = $this->alias[$name];
                $url = $this->{$urlName};
            }
            if (!isset($url))
                throw new \Exception("没有对应的URL", 3001);
            if(count($arg) > 2)
                throw new \Exception("本方法只接受零个或一个参数,请检查", 3002);

            if(count($arg) === 1){
                $ret = http::curl_post($url, $arg[0]);
            }else if(count($arg) === 2){
                $ret = http::sslpost($url, $arg[0], $arg[1]);
            }else{
                $ret = http::curl_get($url);
            }

            if($this->debug){
                if(count($arg) === 2){
                    $this->logger->info('SSLPOST:'.$url);
                    $this->logger->info('input:', $arg);
                }else if(count($arg) === 1){
                    $this->logger->info('POST:'.$url);
                    $this->logger->info('input:', $arg);
                }else{
                    $this->logger->info('GET:'.$url);
                }
                $this->logger->info('outResult:', $ret);
            }
            return $ret;
        }catch(\Exception $e){
            return [$e->getCode(), $e->getMessage()];
        }
    }
}
