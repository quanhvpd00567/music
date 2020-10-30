<?php

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
Route::middleware('basic_auth')->group(function () {


    Route::prefix('category')->group(function () {
        Route::get('{slug}.htm', [EndUser\CategoryController::class, 'categoryDetail'])->name('category.detail');
    });

    View::composer(['music/*'], function ($view) {
        dd(111);
    });

});

Route::get('/', function () {
   return \view('coming_soon');
});

