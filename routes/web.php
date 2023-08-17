<?php

use App\Http\Controllers\Admin\Blog\KategoriBlogController;
use App\Http\Controllers\Admin\Blog\KategoriPostController;
use App\Http\Controllers\Admin\Blog\PostController;
use App\Http\Controllers\Admin\Team\AnggotaController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\Admin\Projects\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Projects\ProjectController;
use App\Http\Controllers\Admin\Team\KategoriJabatanController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Models\Clients;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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
    Route::get('/clients', 'clients')->name('clientpublic');
    Route::get('/contact-us', 'contact')->name('contact');

    Route::get('/projects', 'projects')->name('projects');
    Route::get('/projects/id', 'project_details')->name('project-single');
});

/* PRIVATE ROUTES (WITH AUTH) */
// Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ALL ROUTE WITH PREFIX SETTINGS, EX: localhost/settings/clients etc
Route::prefix('settings')->group(function () {

    // ROUTE RESOURCE CLIENT,KATEGORI,PROJECT,TEAM,PRICE
    /* accessed with ex: localhost/settings/clients/index */
    Route::resources([
        'clients'       => ClientsController::class,
        'categories'    => KategoriController::class,
        'projects'      => ProjectController::class,
        'teams'         => AnggotaController::class,
        'katjab'        => KategoriJabatanController::class,
        'prices'        => PriceController::class,
        'services'      => ServiceController::class,
    ]);


    // ROUTE GROUP WEBSITE SETTING
    /* accessed with prefix website, ex: localhost/settings/website/about-us */
    Route::controller(WebsiteSettingController::class)->prefix('website')->as('website.')->group(function () {

        // MENU ABOUT-US
        Route::get('/about-us', 'index')->name('indexabout');
        Route::get('/carousel-image', 'indexCarousel')->name('indexcarousel');

        // MENU CAROUSEL
        Route::post('/about-us', 'store')->name('storeabout');
        Route::put('/about-us/{id}', 'update')->name('updateabout');

        // MENU WALLPAPER
        Route::get('/wallpaper-menu', 'indexWallpaper')->name('indexwallpaper');
        Route::get('/getallwallpaper', 'getAllWallpaper')->name('getallwallpaper'); // DATATABLES
        Route::get('/wallpaper-menu/{wallpaper}', 'showWallpaperById')->name('showwallpaper');
        Route::patch('/wallpaper-menu/{id}', 'updateWallpaper')->name('updatewallpaper');
    });


    // ROUTE GROUP USER
    /* accessed with prefix users, ex: localhost/settings/users/index */
    Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::patch('/{user}', 'update')->name('update');
        Route::delete('/destroy/{user}', 'destroy')->name('destroy');

        Route::get('/getdatausers', 'getAllUsers')->name('getusers');
        Route::get('/getuser/{id?}', 'getUserById')->name('getuserbyid');

        Route::get('/checkmail/{id?}', 'checkEmailAndUsername')->name('checkmailusername');
        Route::get('/check', 'awewe');
    });


    // ROUTE GROUP BLOG
    /* acessed with prefix blogs, ex: localhost/settings/blogs/posts/index */
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



});


// });


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

// TESTING ROUTE ONLY!
Route::get('/tes', function () {
    // $jabatan = ['CEO','CTO','Manager','Accountant','Marketing'];

    // foreach ($jabatan as $key) {
    //     // Jabatan::create([$key]);
    //     echo $key;
    // }
    $user = User::with('blogs')->get();
    echo 'ea<br>';
    dump($user);
});

require __DIR__ . '/auth.php';
