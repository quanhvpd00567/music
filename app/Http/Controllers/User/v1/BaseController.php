<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function error404($isShowBanner = true)
    {
        return view('public.errors.404', ['isShowBanner' => $isShowBanner]);
    }

    public function error500($isShowBanner = true)
    {
        return view('public.errors.500', ['isShowBanner' => $isShowBanner]);
    }
}
