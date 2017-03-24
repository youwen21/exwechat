<?php

namespace youwen\exwechat;

/**
 * 日志记录
 * @author baiyouwen
 */
class exLog
{
    private static $conf=[
        'path' => '/runtime/log/exwechat/'
    ];
    private static $step = 1;
    private static $uniqid;
    private static $filename = '';

    private static $path='';

    public static function log($param, $tag = '', $conf=[])
    {
        self::_init($conf);
        $str = self::_makeString($param);
        file_put_contents(self::$path . self::$filename . '.txt', date('H:i:s') . "\t" . self::$uniqid . "\t" . self::$step . "\t" . $tag . "\t" . $str . PHP_EOL, FILE_APPEND);
        self::$step++;
    }

    public static function setConf($conf=[])
    {
        if(!empty($conf)){
            self::$conf = $conf;
        }
    }

    private static function _init($conf)
    {
        static $noCheck = 0;
        if ($noCheck) {
            return true;
        }
        if(!empty($conf)){
            self::$conf = $conf;
        }
        self::$path = str_replace('\\', '/', ROOT_PATH . self::$conf['path']);
        if (!is_dir(self::$path )) {
            mkdir(self::$path );
        }
        self::$filename = date('Ymd');
        self::$uniqid = uniqid();
        $noCheck = 1;
    }

    private static function _makeString($argument)
    {
        switch (gettype($argument)) {
            case 'array':
                return self::_arrToJson($argument);
                break;
            case 'object':
            case 'resource':
                return 'object or resource';
                break;
            default:
                return $argument;
                break;
        }
    }

    private static function _arrToJson($array)
    {
        return json_encode($array,JSON_UNESCAPED_UNICODE);
    }

    private static function _formatStep($step)
    {
        if (strlen($step) == 1) {
            return '0' . $step;
        }
    }
}
