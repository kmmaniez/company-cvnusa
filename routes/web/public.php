<?php

/* PUBLIC ROUTES */
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::controller(PublicController::class)->as('public.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/services', 'services')->name('services');
    Route::get('/clients', 'clients')->name('clientpublic');
    Route::get('/contact-us', 'contact')->name('contact');

    // PROJECT
    Route::get('/projects', 'projects')->name('projects');
    Route::get('/projects/{project:slug}', 'project_details')->name('project-single');

    // BLOG
    Route::get('/blog', 'posts')->name('post.all');
    Route::get('/blog/{post:slug}', 'posts')->name('post.detail');

});