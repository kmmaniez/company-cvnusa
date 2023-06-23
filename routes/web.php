<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('public.index');
    Route::get('/about', 'about')->name('public.about');
    Route::get('/pricing', 'pricing')->name('public.pricing');
    Route::get('/services', 'services')->name('public.services');
    Route::get('/testimonials', 'testimonials')->name('public.testimonials');
    Route::get('/contact-us', 'contact')->name('public.contact');
    
    Route::get('/project/id', 'project_details');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
