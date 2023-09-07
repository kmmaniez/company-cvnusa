<?php

use App\Http\Controllers\Admin\Blog\KategoriPostController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Team\AnggotaController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Projects\ProjectController;
use App\Http\Controllers\Admin\Team\KategoriJabatanController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\Projects\KategoriProjectController;
use App\Http\Controllers\Admin\Website\AboutController;
use App\Http\Controllers\Admin\Website\CarouselController;
use App\Http\Controllers\Admin\Website\WallpaperController;
use App\Models\Clients;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
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

        // ROUTE RESOURCE CLIENT,KATEGORI,PROJECT,TEAM,PRICE
        /* accessed with ex: localhost/settings/clients/index */
        Route::middleware(['can:manage-projects'])->group(function () {
            Route::resource('kategoriproject', KategoriProjectController::class);
            Route::resource('projects', ProjectController::class);
        });

        Route::middleware(['can:manage-teams'])->group(function () {
            Route::resource('teams', AnggotaController::class);
            Route::resource('kategorijabatan', KategoriJabatanController::class);
        });

        Route::resource('prices', PriceController::class)->except('edit')->middleware('can:manage-prices');

        Route::resource('services', ServiceController::class)->middleware('can:manage-services');

        Route::resource('clients', ClientsController::class)->middleware('can:manage-clients');


        // ROUTE GROUP WEBSITE SETTING
        /* accessed with prefix website, ex: localhost/settings/landing-page/about-us */
        Route::controller(WebsiteSettingController::class)->middleware('can:manage-websites')->prefix('landing-page')->group(function () {

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

/* ROUTE ONLY FOR DATATABLE */
Route::prefix('datatables')->group(function () {

    // DATA CLIENTS
    Route::get('getdataclients', function () {
        if (request()->ajax()) {
            $model = Clients::all();
            return DataTables::of($model)
                ->editColumn('logo', function ($row) {
                    // $img = '<img src="'.url('photos/client-logo', $row->logo).'" style="object-fit: cover;" width="300" height="150" alt="logo-client">';
                    // // {{ url('photos/client-logo', $client->logo) }}
                    // return $img;
                    return view('admin.client.clientdt', [
                        'logo' => $row->logo
                    ]);
                })
                ->editColumn('action', function ($row) {
                    $btn = '
                        <a href="#" data-client="' . $row->id . '" id="btnEditClient" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                        <a href="#" data-client="' . $row->id . '" id="btnHapusClient" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                    ';
                    return $btn;
                })
                ->toJson();
        }
        abort(404);
    })->name('getdataclients');
});

require __DIR__ . '/web/public.php'; // ROUTE PUBLIC
require __DIR__ . '/auth.php';
