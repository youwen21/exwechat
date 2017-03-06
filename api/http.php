<?php
namespace youwen\exwechat\api;

/**
 * http/https 接口请求
 * @author baiyouwen <youwen21@yeah.net>
 */
class http
{
    //get 通信
    public static function curl_get($url, $data = '')
    {
        if (!empty($array)) {
            if (is_string($data)) {
                $params = $data;
            } else {
                $params = http_build_query($array);
            }
            $url .= '&' . $params;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $ret = [0 => 0, 1 => ''];
        $info = curl_exec($ch);
        if (curl_errno($ch)) {
            $ret[0] = 1;
            $ret[1] = curl_error($ch);
        } else {
            $ret[1] = $info;
        }
        curl_close($ch);
        return $ret;
    }
    //post 通信
    public static function curl_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //此项反回真假值，开启为不显示到桌面
        $ret = [0 => 0, 1 => ''];
        $info = curl_exec($ch);
        // $getinfo = curl_getinfo($ch);
        if (curl_errno($ch)) {
            $ret[0] = 1;
            $ret[1] = curl_error($ch);
        } else {
            $ret[1] = $info;
        }
        curl_close($ch);
        return $ret;
    }

    public static function sslpost($url = '', $data = '')
    {
        //启动一个CURL会话
        $ch = curl_init();

        // 设置curl允许执行的最长秒数
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        // 获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // 从证书中检查SSL加密算法是否存在
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
        //发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        //要传送的所有数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        //第一种方法，cert 与 key 分别属于两个.pem文件
        //默认格式为PEM，可以注释
        curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLCERT, $_SERVER['DOCUMENT_ROOT'] . '/pay/WxpayAPI_php_v3/cert/apiclient_cert.pem');
        //默认格式为PEM，可以注释
        curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($ch, CURLOPT_SSLKEY, $_SERVER['DOCUMENT_ROOT'] . '/pay/WxpayAPI_php_v3/cert/apiclient_key.pem');

        // 对认证证书来源的检查，0表示阻止对证书的合法性的检查。1需要设置CURLOPT_CAINFO
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $ret = [0 => 0, 1 => ''];
        $info = curl_exec($ch); // 执行操作
        if (curl_errno($ch)) {
            $ret[0] = 1;
            $ret[1] = curl_error($ch); //捕抓异常
        } else {
            $ret[1] = $info;
        }
        curl_close($ch); // 关闭CURL会话
        return $ret;
    }

    //https
    public function curl_https_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cu, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //此项反回真假值，开启为不显示到桌面
        $info = curl_exec($ch);
        curl_close($ch);
        if (curl_errno($ch)) {
            //echo 'Errno'.curl_error($ch);
            return curl_error($ch);
        } else {
            return $info;
        }
    }
}
