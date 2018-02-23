
# DEMO 
> 下方代码有部分是thinkphp框架代码，也有操作数据库，在自己项目中使用需要适当修改

```php
<?php
namespace app\exwechat\controller;

use youwen\exwechat\exRequest;
use youwen\exwechat\exWechat;

/**
 * 微信交互控制器
 * @author baiyouwen <youwen21@yeah.net>
 */
class index
{
    // 微信消息对象
    private $exRequest;
    // 数组消息体 － 微信消息对象的局部信息
    private $_msg;

    /**
     * 微信消息入口
     *
     * @author baiyouwen
     */
    public function index()
    {

        // 微信消息单例 和 验证消息签名
        $this->exRequest = exRequest::instance();
        $ToUserName = $this->exRequest->getToUserName();

        // 根据ToUserName获取 appid, token等对应信息
        $conf = new WechatConfig($ToUserName); // 这个不重要,只是取出配置,可无
        $config = [];
        $config['appid'] = $conf->appid;
        $config['token'] = $conf->token;
        $config['encodingAesKey'] = $conf->encodingAesKey;
        // $encryptType = $conf->encryptType;
        $encryptType = 2;

        // 微信验证控制器, 需要token验证消息是否通过
        $exwechat = new exWechat($config['token']);
        // 接口配置 和 签名验证
        $ret = $exwechat->authentication();
        if (is_bool($ret)) {
            if (!$ret) {
                exit('签名验证失败');
            }
        } else {
            //接口配置  开发者模式接入
            exit($ret);
        }

        $ip = \think\Request::instance()->ip();
        if (!$exwechat->checkIP($ip)) {
            exit('不合法的访问');
        }

        // 提取微信消息 － 数组格式
        $this->_msg = $this->exRequest->extractMsg($encryptType, $config, false);
        if ($this->exRequest->errorCode) {
            exit($this->exRequest->errorMsg);
        }

        // 保存消息
        $FromUserName = $this->exRequest->getFromUserName();
        // $postMsg = str_replace([' ',"\r", "\n","\t"], "", $postMsg);
        db('we_message')->insert(['FromUserName' => $FromUserName, 'ToUserName' => $ToUserName, 'message' => $postMsg, 'dateTime' => date('Y-m-d H:i:s')]);
        // 微信消息分类处理
        $this->_msgTypeHandle();
    }

    /**
     * 微信消息分类处理
     * 消息分类控制器接管后续操作
     * @author baiyouwen
     */
    public function _msgTypeHandle()
    {
        switch ($this->_msg['MsgType']) {
            // 点击菜单与关注
            case 'event':
                $cls = new HandleEvent($this->_msg);
                $ret = $cls->handle();
                break;
            // 文本消息
            case 'text':
                $cls = new HandleText($this->_msg);
                $ret = $cls->handle();
                break;
            // 图片消息
            case 'image':
                $cls = new HandleImage();
                $ret = $cls->handle();
                // $cls = new HandleDefault();
                // $ret = $cls->handle('你发了个图片，我告诉你图片不要随便发。');
                break;
            // 地理位置
            case 'location':
                $cls = new HandleLocation($this->_msg);
                $ret = $cls->handle();
                break;
            // 音频消息
            case 'voice':
                $cls = new HandleVoice();
                $ret = $cls->handle();
            // 视频消息
            case 'video':
                $cls = new HandleVideo();
                $ret = $cls->handle();
            // 链接
            case 'link':
            default:
                $cls = new HandleDefault($this->_msg);
                $ret = $cls->handle();
        }
    }
}

```
