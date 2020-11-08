<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Controllers\Controller;
use App\Services\Mobile;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    protected $mobileSerive;
    public function __construct()
    {
        $this->mobileSerive = app(Mobile::class);
    }

    public function isMobile() {
        return Mobile::isMobile();
    }

    public function error404($isShowBanner = true)
    {
        return view('public.errors.404', ['isShowBanner' => $isShowBanner]);
    }

    public function error500($isShowBanner = true)
    {
        return view('public.errors.500', ['isShowBanner' => $isShowBanner]);
    }
}
