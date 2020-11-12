<?php


namespace youwen\exwechat;

class JsonProcess
{
    public function jsonEncode($data)
    {
        return json_encode($data);
    }


    public function jsonDecode($json)
    {
        return json_decode($json, true);
    }
}
