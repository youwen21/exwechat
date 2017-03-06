<?php
namespace youwen\exwechat;

/**
 * 错误信息容器
 */
class errorContainer
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    // error[] = ['code'=>'xx', 'msg'='xx'];
    protected static $allError=[];
    protected static $lastErrorCode = 0;
    protected static $lastErrorMsg = '';

    /**
     * 架构函数
     * @access protected
     * @param array $options 参数
     */
    protected function __construct($options = [])
    {
    }
    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return \loan\app\logic\errorContainer
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }
        return self::$instance;
    }

    /**
     * 获取最后一条错误码
     * @author baiyouwen
     */
    public function getLastCode()
    {
        return self::$lastErrorCode;
    }

    /**
     * 获取最后一条错误信息
     * @author baiyouwen
     */
    public function getLastMsg()
    {
        return self::$lastErrorMsg;
    }

    /**
     * 设置错误信息
     * @author baiyouwen
     */
    public function setError($code, $msg)
    {
        self::$lastErrorCode = $code;
        self::$lastErrorMsg = $msg;
        self::$allError[] = ['code'=>$code, 'msg' => $msg];
        return true;
    }

    /**
     * 获取全部错误信息
     * @author baiyouwen
     */
    public function getAllError()
    {
        return self::$allError;
    }
}