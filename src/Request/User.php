<?php

namespace youwen\exwechat\Request;

use GuzzleHttp\Psr7\Request;

/**
 * 用户管理
 * Class User
 * @package youwen\exwechat\Request
 * @see https://developers.weixin.qq.com/doc/offiaccount/User_Management/User_Tag_Management.html
 */
class User
{
    // 用户标签管理
    const TAGS_CREATE_URL = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token=%s';
    const TAGS_GET_URL = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token=%s';
    const TAGS_UPDATE_URL = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token=%s';
    const TAGS_DELETE_URL = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=%s';
    const USER_TAG_GET_URL = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=%s';
    const TAGS_MEMBERS_BATCH_TAGGING_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=%s';
    const TAGS_MEMBERS_BATCH_UNTAGGING_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token=%s';
    const TAGS_GETID_LIST_URL = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token=%s';

    const UPDATE_REMARK_URL = ' https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=%s';

    const USER_INFO_URL = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=%s&openid=%s&lang=zh_CN';
    const USER_LIST_URL = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=%s&next_openid=%s';

    const MEMBERS_GET_BLACK_LIST_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token=%s';
    const MEMBERS_BATCH_BLACK_LIST_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token=%s';
    const MEMBERS_BATCH_UNBLACK_LIST_URL = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchunblacklist?access_token=%s';

    /**
     * 用户标签管理 - 创建标签
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function tagsCreate($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::TAGS_CREATE_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 用户标签管理 - 获取公众号已创建的标签
     * @param $accessToken
     * @param array $headers
     * @return Request
     */
    public function tagsGet($accessToken, $headers = [])
    {
        $url = sprintf(self::TAGS_GET_URL, $accessToken);
        return new Request('GET', $url, $headers);
    }

    /**
     * 用户标签管理 - 编辑标签
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function tagsUpdate($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::UPDATE_REMARK_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 用户标签管理 - 删除标签
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function tagsDelete($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::UPDATE_REMARK_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 用户标签管理 - 获取标签下粉丝列表
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function userTagGet($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::USER_TAG_GET_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 用户标签管理 -  批量为用户打标签
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function tagsMembersBatchTagging($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::TAGS_MEMBERS_BATCH_TAGGING_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 用户标签管理 -  批量为用户取消标签
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function tagsMembersBatchUntagging($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::TAGS_MEMBERS_BATCH_UNTAGGING_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 用户标签管理 -  获取用户身上的标签列表
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function tagsGetidlist($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::TAGS_GETID_LIST_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }


    /**
     * 设置用户备注名
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function updateRemark($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::TAGS_UPDATE_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 获取用户基本信息(UnionID机制)
     * @param $accessToken
     * @param $openId
     * @param array $headers
     * @return Request
     */
    public function getUserInfo($accessToken, $openId, $headers = [])
    {
        $url = sprintf(self::USER_INFO_URL, $accessToken, $openId);
        return new Request('GET', $url, $headers);
    }

    /**
     * 获取用户列表
     * @param $accessToken
     * @param $openId
     * @param array $headers
     * @return Request
     */
    public function getUserList($accessToken, $openId, $headers = [])
    {
        $url = sprintf(self::USER_LIST_URL, $accessToken, $openId);
        return new Request('GET', $url, $headers);
    }

    /**
     * 黑名单管理 - 获取公众号的黑名单列表
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function memberGetBlackList($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MEMBERS_GET_BLACK_LIST_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 黑名单管理 - 拉黑用户
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function memberBlack($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MEMBERS_BATCH_BLACK_LIST_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }

    /**
     * 黑名单管理 - 取消拉黑用户
     * @param $accessToken
     * @param $body
     * @param array $headers
     * @return Request
     */
    public function memberUnBlack($accessToken, $body, $headers = [])
    {
        $url = sprintf(self::MEMBERS_BATCH_UNBLACK_LIST_URL, $accessToken);
        return new Request('POST', $url, $headers, $body);
    }
}
