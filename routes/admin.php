<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::domain(env('DOMAIN_ADMIN'))->group(function () {
    Route::group(['middleware' => 'checkAdminLogin'], function () {

        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard.index');

        if (false) {
            Route::prefix('master')->name('admin.master.')->group(function () {

                Route::get('images', [Admin\MasterController::class, 'images'])->name('images.list');

                Route::prefix('image')->group(function () {
                    Route::get('', [Admin\MasterController::class, 'createImages'])->name('images.get');
                    Route::post('', [Admin\MasterController::class, 'postImages'])->name('images.post');
                    Route::get('/{id}', [Admin\MasterController::class, 'editImages'])->name('images.edit');
                    Route::post('/{id}', [Admin\MasterController::class, 'updateImages'])->name('images.update');
                });

            });
        }
        Route::get('imports', [Admin\SongController::class, 'import'])->name('admin.import.song');
        Route::post('imports', [Admin\SongController::class, 'importPost'])->name('admin.import.song.post');

        Route::prefix('songs')->name('song.')->group(function () {
            Route::get('/', [Admin\SongController::class, 'index'])->name('list');
            Route::get('add', [Admin\SongController::class, 'add'])->name('add');
            Route::post('create', [Admin\SongController::class, 'create'])->name('create');
            Route::get('edit/{id}', [Admin\SongController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [Admin\SongController::class, 'update'])->name('update');
        });

        Route::prefix('categories')->name('category.')->group(function () {
            Route::get('/', [Admin\CategoryController::class, 'index'])->name('list');
            Route::post('create', [Admin\CategoryController::class, 'create'])->name('create');
            Route::get('edit/{id}', [Admin\CategoryController::class, 'edit'])->name('edit');
            Route::put('update', [Admin\CategoryController::class, 'update'])->name('update');
        });

        Route::get('music', [Admin\MusicController::class, 'getAll'])->name('admin.music.all');

        Route::get('logout', [Admin\AuthController::class, 'logOut'])->name('admin.logout');
    });
    Route::get('login', [Admin\AuthController::class, 'login'])->name('admin.login');
    Route::post('login', [Admin\AuthController::class, 'loginPost'])->name('admin.login.post');
});




