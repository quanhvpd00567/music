<?php

namespace App\Http\Controllers\EndUser\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\userService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    protected $userService;

    const PROVIDER_FACEBOOK = 'facebook';

    public function __construct()
    {
        $this->userService = app(userService::class);
    }

    public function redirectToProvider()
    {
        return Socialite::driver(self::PROVIDER_FACEBOOK)->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $info = Socialite::driver(self::PROVIDER_FACEBOOK)->stateless()->user();
            $user = $this->userService->createMember($info->user, self::PROVIDER_FACEBOOK);
            Auth::login($user);
            return redirect()->route('home');
        } catch (\Exception $exception) {
            return redirect()->route('home');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}