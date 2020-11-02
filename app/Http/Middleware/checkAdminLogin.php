<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Auth;

class checkAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            $user = Auth::user();
            if ($user->role == User::$roles['admin'])
            {
                return $next($request);
            }
        } else {
            Auth::logout();
            return redirect()->route('admin.login');
        }
    }
}
