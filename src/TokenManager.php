<?php

namespace youwen\exwechat;

use Psr\SimpleCache\CacheInterface;
use youwen\exwechat\Exceptions\ExWechatException;
use youwen\exwechat\Request\AccessToken;

class TokenManager
{
    protected $config;

    /**
     * @var CacheInterface;
     */
    protected $cache;

    protected $tokenKey;

    public function __construct($conf, CacheInterface $cache = null, $cacheTokenKey = "exwechat:access:token")
    {
        if (is_array($conf)) {
            $this->config = new Config($conf);
        } elseif ($conf instanceof Config) {
            $this->config = $conf;
        } else {
            throw new \InvalidArgumentException("conf not array or instanceof Config");
        }


        $this->cache = $cache;
        $this->tokenKey = $cacheTokenKey;
    }


    public function getAccessToken()
    {
        if (is_null($this->cache)) {
            throw new ExWechatException("缺失cache支持类，第日获取token次数有限，必须有cache类支持。");
        }

        $token = $this->cache->get($this->tokenKey);
        if (!empty($token)) {
            return $token;
        }

        $request = (new AccessToken())->getAccessToken($this->config->getAppId(), $this->config->getSecret());

        $json = call_user_func_array([new ApiClient, 'send'], [$request]);
        $accessToken = json_decode($json, true);
        if (!isset($accessToken['access_token'])) {
            throw new ExWechatException($json);
        }

        $this->cache->set($this->tokenKey, $accessToken['access_token'], $accessToken['expires_in'] - 200);
        return $accessToken['access_token'];
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * @return CacheInterface
     */
    public function getCache(): CacheInterface
    {
        return $this->cache;
    }

    /**
     * @param CacheInterface $cache
     */
    public function setCache(CacheInterface $cache): void
    {
        $this->cache = $cache;
    }

    /**
     * @return string
     */
    public function getTokenKey(): string
    {
        return $this->tokenKey;
    }

    /**
     * @param string $tokenKey
     */
    public function setTokenKey(string $tokenKey): void
    {
        $this->tokenKey = $tokenKey;
    }
}
