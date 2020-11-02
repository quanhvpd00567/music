<?php
namespace App\Http\Helpers;

use Carbon\Carbon;
use Webpatser\Uuid\Uuid;

class Helper
{
    const KEY_SONG = 'vietmix-';
    const KEY_CATEGORY = 'vietmix-ct-';
    const KEY_SITE = 'vietmix.vn';
    const KEY_AUTHOR = 'QUANHV';

    public static function createUrlSong($song)
    {
//        $base64Encode = base64_encode(self::KEY_SONG . $song->id);
        $slug = $song->link;
        return "$slug-$song->uuid";
    }

    public static function getUuid()
    {
        $uuid = Uuid::generate(1, self::KEY_SITE, Uuid::compare(Carbon::now()->timestamp, self::KEY_AUTHOR));
        return $uuid->node;
    }

    public static function decodeUrlSong($slug)
    {
        $argPath = explode( '-',$slug);
        return last($argPath);
    }

    public static function createUrlCategory($category)
    {
        $base64Encode = base64_encode(self::KEY_CATEGORY . $category->id);
        $slug = $category->slug;
        return "$slug-$base64Encode";
    }

    public static function decodeUrlCategory($slug)
    {
        $idCategory = null;
        $argPath = explode( '-',$slug);
        if (count($argPath) > 0) {
            $last = last($argPath);
            $base64 = explode( '-', base64_decode($last));
            if (count($base64) > 0) {
                $idCategory = last($base64);
            }
        }
        return $idCategory;
    }

    public static function getUuidOfCategory($slug)
    {
        $argPath = explode( '-',$slug);
        return last($argPath);
    }
}
