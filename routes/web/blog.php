<?php

/* BLOG ROUTES */
use App\Http\Controllers\Admin\Blog\KategoriPostController;
use App\Http\Controllers\Admin\Blog\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('blog')->group(function () {

    // ROUTE POST BLOG
    Route::prefix('posts')->as('posts.')->group(function () {

        Route::controller(PostController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');

            Route::get('/{post}/edit', 'edit')->name('edit');
            Route::patch('/{post}', 'update')->name('update');
            Route::delete('/destroy/{post}', 'destroy')->name('destroy');

            Route::get('/getallposts', 'getAllPosts')->name('getallposts'); // DATA TABLE
            Route::get('/checkslug', 'checkSlug')->name('checkslug');
        });
    });

    // ROUTE KATEGORI BLOG
    Route::prefix('kategori')->as('katpost.')->group(function () {

        Route::controller(KategoriPostController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('show/{kategori}', 'show')->name('show');

            Route::put('update/{kategoriPost}', 'update')->name('update');
            Route::get('destroy/{kategoriPost}', 'destroy')->name('destroy');

            Route::get('/getallkatpost', 'getAllKategoris')->name('getallkatposts');
        });
    });
});