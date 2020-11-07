<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\v1\HomeController;
use \App\Http\Controllers\User\v1\CategoryController;
use \App\Http\Controllers\User\v1\SongController;
use \App\Http\Controllers\User\v1\AuthController;

Route::domain(env('DOMAIN_API'))->group(function () {
    Route::namespace('\App\Http\Controllers\User\v1')->group(function () {
        Route::get('', [HomeController::class, 'index'])->name('home');
        Route::get('category/{slug}.html', [CategoryController::class, 'detail'])->name('category.detail');
        Route::get('{slug}.html', [SongController::class, 'detail'])->name('song.detail');
    });

    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('login/{provider}', [AuthController::class, 'redirectToProvider'])->name('socialite_login');
    Route::get('callback/{provider}', [AuthController::class, 'handleProviderCallback'])->name('socialite_callback');


//Route::get('/', function () {
//   return \view('coming_soon');
//})->name('home');

//    Route::get('login', function () {
//        return \view('endUser.login.login');
//    })->name('login');
//
    Route::middleware('checkUser')->group(function () {
//        Route::get('upload-song', [EndUser\UserController::class, 'uploadFile'])->name('user.upload');
//        Route::post('upload-song', [EndUser\UserController::class, 'uploadFilePost'])->name('user.upload.post');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::prefix('user')->name('user.')->group(function () {
//            Route::get('songs', [EndUser\UserController::class, 'listSong'])->name('songs');
        });
    });

});

