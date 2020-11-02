<?php

namespace youwen\exwechat;

class Config
{
    protected $conf = [];

    public function __construct($conf)
    {
        $this->conf = $conf;
    }

    public function getAppId()
    {
        return $this->conf['app_id'] ?? null;
    }

    public function getSecret()
    {
        return $this->conf['secret'] ?? null;
    }

    public function getRedirectUri()
    {
        return $this->conf['redirect_uri'] ?? null;
    }

    public function get($name)
    {
        return $this->conf[$name] ?? null;
    }

    public function set($name, $value)
    {
        $this->conf[$name] = $value;
    }
}
