<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\User\v1\HomeController;
use \App\Http\Controllers\User\v1\CategoryController;
use \App\Http\Controllers\User\v1\SongController;
use \App\Http\Controllers\User\v1\AuthController;
use \App\Http\Controllers\User\v1\UserController;

Route::domain(env('DOMAIN_API'))->group(function () {
    Route::namespace('\App\Http\Controllers\User\v1')->group(function () {
        Route::get('', [HomeController::class, 'index'])->name('home');
        Route::get('category/{slug}.html', [CategoryController::class, 'detail'])->name('category.detail');
        Route::get('{slug}.html', [SongController::class, 'detail'])->name('song.detail');
    });

    Route::get('search', [SongController::class, 'search'])->name('search');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('login/{provider}', [AuthController::class, 'redirectToProvider'])->name('socialite_login');
    Route::get('callback/{provider}', [AuthController::class, 'handleProviderCallback'])->name('socialite_callback');

    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('register.post');

    Route::middleware('checkUser')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('upload', [SongController::class, 'uploadFile'])->name('upload');
            Route::post('upload', [SongController::class, 'uploadFilePost'])->name('upload.post');
            Route::get('song-approved', [UserController::class, 'listSongApproved'])->name('song.approved');
            Route::get('song-in-progress', [UserController::class, 'listSongInProgress'])->name('song.progress');
            Route::get('song-cancel', [UserController::class, 'listSongCancel'])->name('song.cancel');
        });
    });

});

