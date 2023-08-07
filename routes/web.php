<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\Projects\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Projects\ProjectController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\WebsiteSettingController;
use App\Models\Kategori;
use App\Models\WebsiteSetting;
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

/* PUBLIC ROUTES */
Route::controller(PublicController::class)->as('public.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/about', 'about')->name('about');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/services', 'services')->name('services');
    Route::get('/testimonials', 'testimonials')->name('testimonials');
    Route::get('/contact-us', 'contact')->name('contact');
    
    Route::get('/projects-list', 'projects')->name('projects');
    Route::get('/projects-list/id', 'project_details')->name('project-single');

});

/* PRIVATE ROUTES (WITH AUTH) */
// Route::middleware(['auth'])->group(function () {
    
// });

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::prefix('settings')->group(function () {
    
    Route::resources([
        'clients'   => ClientsController::class,
        'kategori'  => KategoriController::class,
        'projects'  => ProjectController::class,
        'teams'     => TeamController::class,
        'prices'    => PriceController::class
    ]);

    Route::controller(WebsiteSettingController::class)->prefix('website')->as('website.')->group(function(){

        // MENU ABOUT-US
        Route::get('/about-us', 'index')->name('indexabout');
        Route::get('/carousel-image','indexCarousel')->name('indexcarousel');
        
        // MENU CAROUSEL
        Route::post('/about-us', 'store')->name('storeabout');
        Route::put('/about-us/{id}', 'update')->name('updateabout');
        
        // MENU WALLPAPER
        Route::get('/wallpaper-menu','indexWallpaper')->name('indexwallpaper');
        Route::put('/wallpaper-menu/{wallpaper}','updateWallpaper')->name('updatewallpaper');
    });

    Route::controller(UserController::class)->prefix('users')->as('users.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');

        Route::get('/checkmail','checkEmail')->name('checkmail');
    });

});

Route::get('/datakategori', function () {
    return response()->json([
        'data' => Kategori::all()
    ]);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// TESTING ROUTE ONLY!
Route::get('/tes', function () {

});

require __DIR__.'/auth.php';
