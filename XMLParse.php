<?php

namespace youwen\exwechat;

/**
 * 这个类是腾讯的DEMO
 */
/**
 * XMLParse class
 *
 * 提供提取消息格式中的密文及生成回复消息格式的接口.
 */
class XMLParse
{

    /**
     * 提取出xml数据包中的加密消息
     * @param string $xmltext 待提取的xml字符串
     * @return string 提取出的加密消息字符串
     */
    public function extract($xmltext)
    {
        try {
            $xml = new \DOMDocument();
            $xml->loadXML($xmltext);
            $array_e = $xml->getElementsByTagName('Encrypt');
            $array_a = $xml->getElementsByTagName('ToUserName');
            $encrypt = $array_e->item(0)->nodeValue;
            $tousername = $array_a->item(0)->nodeValue;
            return array(0, $encrypt, $tousername);
        } catch (\Exception $e) {
            //print $e . "\n";
            return array(ErrorCode::$ParseXmlError, null, null);
        }
    }

    /**
     * XML转数组
     * @author baiyouwen
     */
    public static function xmlToArray($xml)
    {
        $data = [];
        $postObj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $data = self::_xml2arr($postObj);
        return $data;
    }

    private static function _xml2arr($obj, $l = 1)
    {
        $arr = array();
        foreach ($obj as $key => $value) {
            if (isset($arr[$key])) {
                if (isset($arr[$key][0])) {
                    if ($value->children()) {
                        $arr[$key][] = self::_xml2arr($value, $l++);
                    } else {
                        $arr[$key][] = strval($value);
                    }
                } else {
                    $arr[$key] = array($arr[$key]);
                    if ($value->children()) {
                        $arr[$key][] = self::_xml2arr($value, $l++);
                    } else {
                        $arr[$key][] = strval($value);
                    }
                }
            } else {
                if ($value->children()) {
                    $arr[$key] = self::_xml2arr($value, $l++);
                } else {
                    $arr[$key] = strval($value);
                }
            }
        }
        return $arr;
    }

}
