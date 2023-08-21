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

            Route::get('/getallposts', 'getAllPosts')->name('getallposts');
        });
    });

    // ROUTE KATEGORI BLOG
    Route::prefix('kategori')->as('katpost.')->group(function () {

        Route::controller(KategoriPostController::class)->group(function () {
            Route::post('store', 'store')->name('store');
            Route::get('destroy/{kategoriBlog}', 'destroy')->name('destroy');

            Route::get('/getallkatpost', 'getAllKategoris')->name('getallkatposts');
        });
    });
});