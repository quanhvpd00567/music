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


Route::get('/', [EndUser\MusicController::class, 'index']);


Route::prefix('music')->middleware('cors')->group(function () {
    Route::get('detail/{slug}.htm', [EndUser\MusicController::class, 'musicDetail'])->name('song.detail');
//    Route::get('detail2/{slug}.htm', [EndUser\MusicController::class, 'musicDetail2'])->name('song.detail2');
});
Route::prefix('category')->group(function () {
    Route::get('{slug}.htm', [EndUser\CategoryController::class, 'categoryDetail'])->name('category.detail');
});

View::composer(['music/*'], function ($view) {
    dd(111);
});
