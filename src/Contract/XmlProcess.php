<?php

namespace youwen\exwechat;

class XmlProcess
{
//    public function extract($xmltext)
//    {
//        try {
//            $xml = new \DOMDocument();
//            $xml->loadXML($xmltext);
//
//            $array_e = $xml->getElementsByTagName('Encrypt');
//            $array_a = $xml->getElementsByTagName('ToUserName');
//            $encrypt = $array_e->item(0)->nodeValue;
//            $tousername = $array_a->item(0)->nodeValue;
//            return array(0, $encrypt, $tousername);
//        } catch (\Exception $e) {
//            //print $e . "\n";
//            return array(ErrorCode::$ParseXmlError, null, null);
//        }
//    }

    public function arrayToXml($array)
    {
        return '';
    }

    public function xmlToArray($xml)
    {
        $postObj = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $data = $this->_xml2arr($postObj);
        return $data;
    }

    private function _xml2arr($obj, $l = 1)
    {
        $arr = array();
        foreach ($obj as $key => $value) {
            if (isset($arr[$key])) {
                if (isset($arr[$key][0])) {
                    if ($value->children()) {
                        $arr[$key][] = $this->_xml2arr($value, $l++);
                    } else {
                        $arr[$key][] = strval($value);
                    }
                } else {
                    $arr[$key] = array($arr[$key]);
                    if ($value->children()) {
                        $arr[$key][] = $this->_xml2arr($value, $l++);
                    } else {
                        $arr[$key][] = strval($value);
                    }
                }
            } else {
                if ($value->children()) {
                    $arr[$key] = $this->_xml2arr($value, $l++);
                } else {
                    $arr[$key] = strval($value);
                }
            }
        }
        return $arr;
    }

//    function getAttrData(string $attr, \DomDocument $dom) {
//        // Empty array to hold all classes to return
//        $attrData = array();
//
//        //Loop through each tag in the dom and add it's attribute data to the array
//        foreach($dom->getElementsByTagName('*') as $tag) {
//            if(empty($tag->getAttribute($attr)) === false) {
//                array_push($attrData, $tag->getAttribute($attr));
//            }
//        }
//
//        //Return the array of attribute data
//        return array_unique($attrData);
//    }

//    public static function getArray($node)
//    {
//        $array = false;
//
//        if ($node->hasAttributes()) {
//            foreach ($node->attributes as $attr) {
//                $array[$attr->nodeName] = $attr->nodeValue;
//            }
//        }
//
//        if ($node->hasChildNodes()) {
//            if ($node->childNodes->length == 1) {
//                $array[$node->firstChild->nodeName] = $node->firstChild->nodeValue;
//            } else {
//                foreach ($node->childNodes as $childNode) {
//                    if ($childNode->nodeType != XML_TEXT_NODE) {
//                        $array[$childNode->nodeName][] = self::getArray($childNode);
//                    }
//                }
//            }
//        }
//
//        return $array;
//    }
}
