<?php

namespace youwen\exwechat\api\pay;

/**
* 微信下单数据
*/
class ApiData
{
    protected $_data = [];

    function __construct(array $argument)
    {
        $this->_data = $argument;
    }

    public function setData(array $data)
    {
        $this->_data = array_merge($this->_data, $data);
    }

    public function setOne($key, $value)
    {
        $this->_data[$key] = $value;
        return $this;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    public function __get($key)
    {
        return isset($this->_data[$key])? $this->_data[$key] : false;
    }

}