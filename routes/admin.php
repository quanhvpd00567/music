<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::group([], function () {
    Route::prefix('master')->name('admin.master.')->group(function () {
        Route::get('sites', [Admin\MasterController::class, 'index'])->name('site_list');
        Route::post('sites/change-batch', [Admin\MasterController::class, 'changeBatch'])->name('change_status_batch');
        Route::get('site/{id}/categories', [Admin\MasterController::class, 'category'])->name('category_list');
        Route::get('images', [Admin\MasterController::class, 'images'])->name('images.list');
        Route::get('image', [Admin\MasterController::class, 'createImages'])->name('images.get');
        Route::post('image', [Admin\MasterController::class, 'postImages'])->name('images.post');
        Route::get('image/{id}', [Admin\MasterController::class, 'editImages'])->name('images.edit');
        Route::post('image/{id}', [Admin\MasterController::class, 'updateImages'])->name('images.update');
    });
    Route::get('music', [Admin\MusicController::class, 'getAll'])->name('admin.music.all');

});

Route::get('login', [Admin\AuthController::class, 'login'])->name('admin.login');



