<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login.index');
    }

    public function loginPost(Request $request)
    {
        $params = $request->only([
            'email', 'password'
        ]);
        if (Auth::attempt($params)) {
            return redirect()->route('admin.master.site_list');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
