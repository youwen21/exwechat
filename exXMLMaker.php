<?php
namespace youwen\exwechat;

class exXMLMaker
{
    private $_FromUserName = '';
    private $_ToUserName = '';
    public function __construct($FromUserName = '', $ToUserName='')
    {
        if(empty($FromUserName) || empty($ToUserName)){
            $msg = exRequest::instance()->getMsg();
            $this->_FromUserName = $msg['FromUserName'];
            $this->_ToUserName = $msg['ToUserName'];
        }else{
            $this->_FromUserName = $FromUserName;
            $this->_ToUserName = $ToUserName;
        }
    }
    //创建文本消息
    private $textTpl = '<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>';
    public function createText($contentStr='', $from='', $to='')
    {
        $FromUserName = empty($from)? $this->_FromUserName : $from;
        $ToUserName = empty($to)? $this->_ToUserName : $to;
        empty($contentStr) ? $contentStr = "谢谢关注" : $contentStr;
        return sprintf($this->textTpl, $FromUserName, $ToUserName, time(), 'text', $contentStr);
    }

    public function createNews($newres=[], $from='', $to='')
    {
        $FromUserName = empty($from)? $this->_FromUserName : $from;
        $ToUserName = empty($to)? $this->_ToUserName : $to;
        $str = "<xml>";
        $str .= "<ToUserName><![CDATA[" . $FromUserName . "]]></ToUserName>";
        $str .= "<FromUserName><![CDATA[" . $ToUserName . "]]></FromUserName>";
        $str .= "<CreateTime>" . time() . "</CreateTime>";
        $str .= "<MsgType><![CDATA[news]]></MsgType>";
        $str .= "<ArticleCount>" . count($newres) . "</ArticleCount>";
        $str .= "<Articles>";

        foreach ($newres as $value) {
            // url关键字替换成用户openid
            $url = str_replace('openidvalue', $FromUserName, $value['url']);

            $str .= "<item>";
            $str .= "<Title><![CDATA[" . $value['title'] . "]]></Title>";
            $str .= "<Description><![CDATA[" . $value['description'] . "]]></Description>";
            $str .= "<PicUrl><![CDATA[" . $value['picurl'] . "]]></PicUrl>";
            $str .= "<Url><![CDATA[" . $url . "]]></Url>";
            $str .= "</item>";
        }
        $str .= "</Articles>";
        $str .= "</xml>";
        return $str;
    }

    protected function response_image($media_id = '', $from='', $to='')
    {
        $FromUserName = empty($from)? $this->_FromUserName : $from;
        $ToUserName = empty($to)? $this->_ToUserName : $to;
        $str = '<xml>';
        $str .= '<ToUserName><![CDATA[' . $FromUserName . ']]></ToUserName>';
        $str .= '<FromUserName><![CDATA[' . $ToUserName . ']]></FromUserName>';
        $str .= '<CreateTime>' . time() . '</CreateTime>';
        $str .= '<MsgType><![CDATA[image]]></MsgType>';
        $str .= '<Image>';
        $str .= '<MediaId><![CDATA[' . $media_id . ']]></MediaId>';
        $str .= '</Image>';
        $str .= '</xml>';
        return $str;
    }
}
