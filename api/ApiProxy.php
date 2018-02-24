<?php

namespace youwen\exwechat\api\pay;

/**
* API端口代理
* 暂时未启用, API当中有部门分接口开发不规范,此API代理暂是不能使用
*/
class ApiProxy
{
    protected $_obj;

    function __construct($obj)
    {
        $this->_obj = $obj;
    }

    public function __call($name, $arg)
    {

        $ret = call_user_func([$this->_obj, $name], $arg);
    }

}