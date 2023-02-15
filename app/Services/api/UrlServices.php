<?php

namespace App\Services\api;

class UrlServices{
    public static $url="http://api-ticketing.mykipart.com";

    public static function getUrl(){
        return self::$url;
    }
}
