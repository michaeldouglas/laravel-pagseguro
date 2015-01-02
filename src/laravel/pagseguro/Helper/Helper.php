<?php

namespace laravel\pagseguro\Helper;

class Helper
{
    public static function setVerifyKeyItem($item, $key){
        return (array_key_exists($key, $item) ? $item[$key] : null);
    }
}
