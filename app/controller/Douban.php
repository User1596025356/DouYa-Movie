<?php


namespace app\controller;


use think\facade\Cache;
use think\facade\Request;

class Douban
{
    public function proxy()
    {
        $request_url = ltrim(Request::Url(), "/uieee");
        if($result = cache::get($request_url))
        {
            return $result;
        }else{
            $result = curl_get("https://douban.uieee.com/".$request_url, $httpCode);
            if($httpCode == 200)
            {
                Cache::set($request_url, $result, 28800);
            }
            return $result;
        }
    }
}