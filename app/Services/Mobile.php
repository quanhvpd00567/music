<?php

namespace App\Services;
use Browser;
class Mobile
{
    public static function isMobile()
    {
        $isPhone = Browser::deviceModel('iPhone') == 'iPhone';
        $isAndroid = Browser::isAndroid();
        $isMobile = Browser::isMobile();

        if ($isPhone || $isAndroid || $isMobile) {
            return true;
        }
        return false;
    }
}
