<?php
namespace youwen\exwechat;

class exResponse
{
    public function __construct()
    {

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
    public function createText($data, $contentStr='')
    {
        empty($contentStr) ? $contentStr = "谢谢关注" : $contentStr;
        return sprintf($this->textTpl, $data['FromUserName'], $data['ToUserName'], time(), 'text', $contentStr);
    }

    public function createNews(&$data, $newres=[])
    {
        $str = "<xml>";
        $str .= "<ToUserName><![CDATA[" . $data['FromUserName'] . "]]></ToUserName>";
        $str .= "<FromUserName><![CDATA[" . $data['ToUserName'] . "]]></FromUserName>";
        $str .= "<CreateTime>" . time() . "</CreateTime>";
        $str .= "<MsgType><![CDATA[news]]></MsgType>";
        $str .= "<ArticleCount>" . count($newres) . "</ArticleCount>";
        $str .= "<Articles>";

        foreach ($newres as $value) {
            // url关键字替换成用户openid
            $url = str_replace('openidvalue', $data['FromUserName'], $value['url']);

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

    protected function response_image(&$data, $media_id = '')
    {
        $str = '<xml>';
        $str .= '<ToUserName><![CDATA[' . $data['FromUserName'] . ']]></ToUserName>';
        $str .= '<FromUserName><![CDATA[' . $data['ToUserName'] . ']]></FromUserName>';
        $str .= '<CreateTime>' . time() . '</CreateTime>';
        $str .= '<MsgType><![CDATA[image]]></MsgType>';
        $str .= '<Image>';
        $str .= '<MediaId><![CDATA[' . $media_id . ']]></MediaId>';
        $str .= '</Image>';
        $str .= '</xml>';
        return $str;
    }
}
