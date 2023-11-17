<?php

use App\Http\Controllers\Admin\Blog\KategoriPostController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\ClientsController;
use App\Http\Controllers\Admin\Team\AnggotaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Projects\ProjectController;
use App\Http\Controllers\Admin\Team\KategoriJabatanController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\Projects\KategoriProjectController;
use App\Http\Controllers\Admin\Website\AboutController;
use App\Http\Controllers\Admin\Website\CarouselController;
use App\Http\Controllers\Admin\Website\InformasiController;
use App\Http\Controllers\Admin\Website\WallpaperController;
use App\Models\Clients;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\directoryExists;

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


/* PRIVATE ROUTES (WITH AUTH) */
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ALL ROUTE WITH PREFIX SETTINGS, EX: localhost/settings/clients etc
    Route::prefix('settings')->group(function () {

        // ROUTE RESOURCE KATEGORI,PROJECT
        /* accessed with ex: localhost/settings/clients/index */
        Route::middleware(['can:manage-projects'])->group(function () {
            Route::resource('kategoriproject', KategoriProjectController::class);

            // ROUTE POST BLOG
            Route::prefix('projects')->group(function () {

                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/', 'index')->name('projects.index');
                    Route::get('/create', 'create')->name('projects.create');
                    Route::post('/', 'store')->name('projects.store');

                    Route::get('/{project}/edit', 'edit')->name('projects.edit');
                    Route::patch('/{project}', 'update')->name('projects.update');
                    Route::delete('/{project}', 'destroy')->name('projects.destroy');
                    Route::delete('/delete-image/{project}', 'deleteAllImages')->name('projects.deleteAllImages');

                    Route::get('/checkslug', 'checkSlug')->name('projects.checkslug');
                });
            });
        });

        // ROUTE GROUP TEAMS & KATEGORI JABATAN
        Route::middleware(['can:manage-teams'])->group(function () {
            Route::resource('teams', AnggotaController::class);
            Route::resource('kategorijabatan', KategoriJabatanController::class);
        });

        // ROUTE GROUP PRICES
        Route::middleware(['can:manage-prices'])->group(function () {
            Route::resource('prices', PriceController::class)->except('edit');
        });

        // ROUTE GROUP SERVICES
        Route::middleware(['can:manage-services'])->group(function () {
            Route::resource('services', ServiceController::class)->except('create');
        });
        
        // ROUTE GROUP CLIENTS
        /* accessed with prefix clients, ex: localhost/settings/clients/index */
        Route::middleware(['can:manage-clients'])->group(function () {

            Route::controller(ClientsController::class)->group(function () {
                Route::get('/clients', 'index')->name('clients.index');
                Route::post('/clients', 'store')->name('clients.store');
                Route::get('/clients/{client}', 'show')->name('clients.show');

                Route::patch('/clients/{client}', 'update')->name('clients.update');
                Route::delete('/clients/{client}', 'destroy')->name('clients.destroy');
                // Route::get('/clients/getdataclients', 'getAllClients')->name('clients.getclients');
            });
            
        });

        // ROUTE GROUP WEBSITE SETTING
        /* accessed with prefix website, ex: localhost/settings/landing-page/about-us */
        Route::middleware(['can:manage-websites'])->group(function () {
            
            Route::controller(WebsiteSettingController::class)->prefix('landing-page')->group(function () {
    
                // MENU ABOUT-US
                Route::controller(AboutController::class)->prefix('about-us')->group(function(){
                    Route::get('/', 'index')->name('about.index');
                    Route::post('/', 'store')->name('about.store');
                    Route::put('/{id}', 'update')->name('about.update');
                });
                
                // MENU CAROUSEL
                Route::resource('carousels', CarouselController::class)->only([
                    'index','store','show','update','destroy'
                ]);
    
                // MENU WALLPAPER
                Route::controller(WallpaperController::class)->prefix('wallpapers')->group(function(){
                    Route::get('/','index')->name('wallpaper.index');
                    Route::get('/getallwallpaper','getAllWallpaper')->name('wallpaper.getallwallpaper');
                    Route::get('/{wallpaper}','show')->name('wallpaper.show');
                    Route::patch('/{wallpaper}','update')->name('wallpaper.update');
                });
    
                // MENU CAROUSEL
                Route::resource('informasi', InformasiController::class)->only([
                    'index','store','update'
                ]);
    
            });
        });

        // ROUTE GROUP USER
        /* accessed with prefix users, ex: localhost/settings/users/index */
        Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::patch('/{user}', 'update')->name('update');
            Route::delete('/destroy/{user}', 'destroy')->name('destroy');

            Route::get('/getdatausers', 'getAllUsers')->name('getusers');
            Route::get('/getuser/{user?}', 'getUserById')->name('getuserbyid');

            Route::get('/checkmail/{id?}', 'checkEmailAndUsername')->name('checkmailusername');
            Route::get('/check', 'awewe');
        });


        // ROUTE GROUP BLOG
        /* acessed with prefix blogs, ex: localhost/settings/blogs/posts/index */
        require __DIR__ . '/web/blog.php'; // ROUTE BLOG

    });


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/web/public.php'; // ROUTE PUBLIC
require __DIR__ . '/auth.php';
