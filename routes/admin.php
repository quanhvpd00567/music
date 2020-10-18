<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::middleware('basic_auth')->group(function () {
    Route::group(['middleware' => 'checkAdminLogin'], function () {
        Route::prefix('master')->name('admin.master.')->group(function () {

            Route::prefix('sites')->group(function () {
                Route::get('/', [Admin\MasterController::class, 'index'])->name('site_list');
                Route::post('change-batch', [Admin\MasterController::class, 'changeBatch'])->name('change_status_batch');
                Route::prefix('{id}/categories')->group(function () {
                    Route::get('', [Admin\MasterController::class, 'category'])->name('category_list');
                    Route::get('create', [Admin\MasterController::class, 'createMasterCategory'])->name('category.add');
                    Route::post('create', [Admin\MasterController::class, 'postMasterCategory'])->name('category.post');
                    Route::get('edit/{idCategory}', [Admin\MasterController::class, 'editMasterCategory'])->name('category.edit');
                    Route::post('edit/{idCategory}', [Admin\MasterController::class, 'updateMasterCategory'])->name('category.update');
                });
            });

            Route::get('images', [Admin\MasterController::class, 'images'])->name('images.list');

            Route::prefix('image')->group(function () {
                Route::get('', [Admin\MasterController::class, 'createImages'])->name('images.get');
                Route::post('', [Admin\MasterController::class, 'postImages'])->name('images.post');
                Route::get('/{id}', [Admin\MasterController::class, 'editImages'])->name('images.edit');
                Route::post('/{id}', [Admin\MasterController::class, 'updateImages'])->name('images.update');
            });

        });

        Route::prefix('songs')->name('song.')->group(function () {
            Route::get('add', [Admin\SongController::class, 'add'])->name('add');
            Route::post('create', [Admin\SongController::class, 'create'])->name('create');
        });

        Route::get('music', [Admin\MusicController::class, 'getAll'])->name('admin.music.all');

        Route::get('logout', [Admin\AuthController::class, 'logOut'])->name('admin.logout');
    });
});






