<?php

namespace youwen\exwechat;

use youwen\exwechat\Request\Ips;
use youwen\exwechat\Request\WebOAuthToken;

class WechatFacade
{
    public $tokenManager;
    public $apiClient;

    public function __construct(TokenManager $tokenManager, ApiClient $apiClient = null)
    {
        $this->tokenManager = $tokenManager;

        if (is_null($apiClient)) {
            $this->apiClient = $apiClient;
        }
    }

    public function getIps()
    {
        $ipRequest = Ips::getIps($this->tokenManager->getAccessToken());
        return $this->apiClient->requestHandleJson($ipRequest);
    }

    public function getAccessToken()
    {
        return $this->tokenManager->getAccessToken();
    }

    public function getWebOauthUri($scope = WebOAuthToken::OPENID_SCOPE)
    {
        return WebOAuthToken::getScopeCodeUrl(
            $this->tokenManager->getConfig()->getAppId(),
            $this->tokenManager->getConfig()->getRedirectUri(),
            $scope
        );
    }

    public function getWebOauthTokenByCode($code)
    {
        $request = WebOAuthToken::getOauthToken($this->tokenManager->getConfig()->getAppId(), $this->tokenManager->getConfig()->getSecret(), $code);
        return $this->apiClient->requestHandleJson($request);
    }
}
