<?php

namespace App\Http\Controllers\User\v1;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\userService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends BaseController
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

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('public.auth.login', ['isShowBanner' => true]);
    }

    public function loginPost(LoginRequest $request)
    {
        try{
            if (Auth::check()) {
                return redirect()->route('home');
            }
            $credentials = $request->only([
                'email', 'password'
            ]);
            if (Auth::attempt($credentials)) {
                return redirect()->route('home');
            }
        } catch (\Exception $exception) {
            return $this->error404();
        }
    }

    public function register()
    {
        return view('public.auth.register', ['isShowBanner' => true]);
    }

    public function registerPost(RegisterRequest $request)
    {
        try {
            $params = $request->only([
                'name', 'phone', 'password', 'email'
            ]);

            $params['password'] = bcrypt($params['password']);
            $params['provider'] = '';
            $params['provider_id'] = '';
            $params['role'] = User::$roles['member'];
            $user = $this->userService->registerMember($params);
            if ($user) {
                Auth::login($user);
                return redirect()->route('home');
            }
            return redirect()->route('register');
        } catch (\Exception $exception) {
            return redirect()->route('register');
        }
    }
}
