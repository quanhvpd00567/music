<?php

use App\Http\Controllers\EndUser\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EndUser;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('xxxx', function () {
   return 111;
});

Route::get('/test', [EndUser\MusicController::class, 'index']);
Route::get('detail/{slug}.html', [EndUser\MusicController::class, 'musicDetail'])->name('song.detailx');
Route::prefix('music')->group(function () {
    Route::get('detail/{slug}.html', [EndUser\MusicController::class, 'musicDetail'])->name('song.detail');
});

Route::get('search', [EndUser\MusicController::class, 'search'])->name('song.search');

//Route::middleware('basic_auth')->group(function () {


    Route::prefix('category')->group(function () {
        Route::get('{slug}.htm', [EndUser\CategoryController::class, 'categoryDetail'])->name('category.detail');
    });

    View::composer(['music/*'], function ($view) {
        dd(111);
    });

//});
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider'])->name('socialite_login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('callback/{provider}', [LoginController::class, 'handleProviderCallback'])->name('socialite_callback');

Route::get('/', function () {
   return \view('coming_soon');
})->name('home');

Route::get('login', function () {
    return \view('endUser.login.login');
})->name('login');

