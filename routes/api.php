<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::domain(env('DOMAIN_API'))->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('songs')->name('song.')->group(function () {
            Route::get('', [Api\MusicController::class, 'getListSong'])->name('list');
            Route::get('detail', [Api\MusicController::class, 'detail'])->name('list');
        });

        Route::prefix('categories')->group(function () {

        });
    });
});
