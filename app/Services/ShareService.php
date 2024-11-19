<?php

namespace App\Services;

class ShareService
{
    public static function getUserIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $cip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $cip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $cip = $_SERVER['REMOTE_ADDR'];
        } else {
            $cip = '無法取得IP位址!!';
        }

        return $cip;
    }

    public static function addViewData($data)
    {
        $my_ip = self::getUserIp();

        views($data)
        ->collection($my_ip)
        ->record();
    }
}
