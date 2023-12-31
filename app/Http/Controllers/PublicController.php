<?php

namespace App\Http\Controllers;

use App\Models\Blog\KategoriPost;
use App\Models\Blog\Post;
use App\Models\Team\Anggota;
use App\Models\Website\Carousel;
use App\Models\Clients;
use App\Models\Price;
use App\Models\Project\Project;
use App\Models\Service;
use App\Models\Website\Informasi;
use App\Models\Website\Wallpaper;
use App\Models\Website\WebsiteSetting;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    /* VIEW DEFAULT */
    public function index()
    {
        return view('public.index',[
            'clients'       => Clients::all(),
            'services'      => Service::all('title','description'),
            'carousels'     => Carousel::all('slide_title','slide_subtitle','description','image'),
            'projects'      => Project::all(),
            'totalproject'  => Project::all()->count(),
            'totalstaff'    => Anggota::all()->count(),
            'totalclient'   => Clients::all()->count(),
            'dataweb'       => Informasi::all(),
            'posts'         => Post::latest('id')->limit(3)->get(['id','title','slug','thumbnail','created_at'])
        ]);
    }
    
    /* VIEW MENU ABOUT */
    public function about()
    {
        return view('public.about',[
            'title'     => 'Halaman About',
            'data'      => WebsiteSetting::all(),
            'dataweb'   => Informasi::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','about')->get('wallpaper_image'),
            'teams'     => Anggota::all()
        ]);
    }

    /* VIEW MENU PRICING */
    public function pricing()
    {
        return view('public.pricing',[
            'title'     => 'Halaman Harga',
            'dataweb'   => Informasi::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','pricing')->get('wallpaper_image'),
            'prices'    => Price::all()
        ]);
    }

    /* VIEW MENU SERVICES */
    public function services()
    {
        return view('public.services',[
            'title'     => 'Halaman Service ',
            'dataweb'   => Informasi::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','services')->get('wallpaper_image'),
            'services'  => Service::all()
        ]);
    }

    /* VIEW MENU CLIENTS */
    public function clients()
    {
        return view('public.clients',[
            'title'     => 'Halaman Client',
            'dataweb'   => Informasi::all(),
            'data'      => Clients::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','clients')->get('wallpaper_image'),
        ]);
    }

    /* VIEW MENU CONTACT */
    public function contact()
    {
        return view('public.contact',[
            'title'     => 'Halaman Contact',
            'dataweb'   => Informasi::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','clients')->get('wallpaper_image'),
        ]);
    }

    /* VIEW MENU PROJECTS */
    public function projects(Request $request)
    {
        $wallpaper = Wallpaper::where('section_name','LIKE','projects')->get('wallpaper_image');
        $data = Project::all();

        return view('public.projects',[
            'title' => 'Halaman Projects',
            'dataweb'       => Informasi::all(),
            'req' => $request,
            'data' => $data,
            'wallpaper' => $wallpaper
        ]);
    }

    /* VIEW MENU PROJECT DETAIL */
    public function project_details(Project $project)
    {
        return view('public.projects-single',[
            'data'      => $project,
            'dataweb'   => Informasi::all(),
        ]);
    }

    /* VIEW MENU BLOG */
    /* FUNGSI TAMPIL SEMUA POST, POST BY KATEGORI & DETAIL POST */
    public function posts(Post $post = null)
    {
        $kategoriParam  = request('kategori');
        $authorParam    = request('penulis');
        $kategoriAll    = KategoriPost::all('nama_kategori');
        $dataweb        = Informasi::all();

        $recentPosts    = Post::with('users')->latest('id')->limit(5)->get(['id','title','slug','thumbnail','created_at']);

        if ($kategoriParam || $authorParam) {

            $postWithKategori = Post::with('kategoris')
                    ->whereRelation('kategoris','nama_kategori','LIKE', $kategoriParam)
                    ->get();
            $postWithAuthor = Post::with('users')
                    ->whereRelation('users','username','=', $authorParam)
                    ->get();

            if (isset($kategoriParam)) {
                return view('public.blog.posts',[
                    'title'         => 'Kategori '.$kategoriParam,
                    'posts'         => $postWithKategori,
                    'dataweb'       => $dataweb,
                    'kategori'      => $kategoriAll,
                    'recentposts'   => $recentPosts
                ]);
            }
            if (isset($authorParam)) {
                return view('public.blog.posts',[
                    'title'         => 'Penulis '.$authorParam,
                    'posts'         => $postWithAuthor,
                    'dataweb'       => $dataweb,
                    'kategori'      => $kategoriAll,
                    'recentposts'   => $recentPosts
                ]);
            }

        }else{
            /* TAMPIL DETAIL POST & TAMPIL RECENT POST SELAIN POST YG DILIHAT */
            if (isset($post)) {
                $recentPosts = Post::with('users')
                                ->where('id','!=', $post->id)->latest('id')
                                ->limit(5)
                                ->get(['id','title','slug','thumbnail','created_at']);
            
                return view('public.blog.post',[
                    'title'         => $post->title,
                    'post'          => $post,
                    'dataweb'       => $dataweb,
                    'kategori'      => $kategoriAll,
                    'recentposts'   => $recentPosts
                ]);

            }else{
                /* TAMPIL SEMUA POST (DEFAULT TAMPILAN HALAMAN BLOG)*/
                $posts = Post::with('users')->latest('id')->paginate(3);
                
                return view('public.blog.posts',[
                    'title'         => 'Blog '. env('APP_NAME'),
                    'kategori'      => $kategoriAll,
                    'dataweb'       => $dataweb,
                    'posts'         => $posts,
                    'recentposts'   => $recentPosts
                ]);
            }
        }
    }
}
