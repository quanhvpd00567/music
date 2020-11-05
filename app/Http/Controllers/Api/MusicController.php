<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicController extends BaseController
{
    public function getListSong()
    {
        return $this->success(true);
    }
}
