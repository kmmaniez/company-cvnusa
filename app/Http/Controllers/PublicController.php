<?php

namespace App\Http\Controllers;

use App\Models\Blog\KategoriPost;
use App\Models\Blog\Post;
use App\Models\Team\Anggota;
use App\Models\Carousel;
use App\Models\Clients;
use App\Models\Kategori;
use App\Models\Price;
use App\Models\Project\Project;
use App\Models\Service;
use App\Models\Wallpaper;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function index()
    {
        return view('public.index',[
            'client' => Clients::all(),
            'services' => Service::all('title','description'),
            'carousels' => Carousel::all('slide_title','slide_subtitle','description','image'),
            'totalproject' => Project::all()->count(),
            'totalstaff' => Anggota::all()->count(),
            'totalclient' => Clients::all()->count(),
            'posts' => Post::latest('id')->limit(3)->get(['id','title','slug','thumbnail','created_at'])
        ]);
    }
    
    public function about()
    {
        return view('public.about',[
            'title' => 'Halaman About',
            'data' => WebsiteSetting::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','about')->get('wallpaper_image'),
            'teams' => Anggota::all()
        ]);
    }

    public function pricing()
    {
        return view('public.pricing',[
            'title' => 'Halaman Harga',
            'wallpaper' => Wallpaper::where('section_name','LIKE','pricing')->get('wallpaper_image'),
            'prices' => Price::all()
        ]);
    }

    public function services()
    {
        return view('public.services',[
            'title' => 'Halaman Service ',
            'wallpaper' => Wallpaper::where('section_name','LIKE','services')->get('wallpaper_image'),
            'services' => Service::all()
        ]);
    }

    public function clients()
    {
        return view('public.clients',[
            'title' => 'Halaman Client',
            'data' => Clients::all(),
            'wallpaper' => Wallpaper::where('section_name','LIKE','clients')->get('wallpaper_image'),
        ]);
    }

    public function contact()
    {
        return view('public.contact',[
            'title' => 'Halaman Contact',
        ]);
    }

    public function projects(Request $request)
    {
        $wallpaper = Wallpaper::where('section_name','LIKE','projects')->get('wallpaper_image');

        if ($request->has('lists')) {
            echo 'projectss';
        }
        return view('public.projects',[
            'title' => 'Halaman Projects',
            'req' => $request,
            'wallpaper' => $wallpaper
        ]);
    }

    public function project_details()
    {
        return view('public.projects-single');
    }

    /* FUNGSI TAMPIL SEMUA POST, POST BY KATEGORI & DETAIL POST */
    public function posts(Post $post = null)
    {
        $kategoriParam = request('kategori');
        $authorParam = request('penulis');
        $kategoriAll = KategoriPost::all('nama_kategori');
        $recentPosts = Post::with('users')->latest('id')->limit(5)->get(['id','title','slug','thumbnail','created_at']);

        if ($kategoriParam || $authorParam) {

            $postWithKategori = Post::with('kategoris')
                    ->whereRelation('kategoris','nama_kategori','LIKE', $kategoriParam)
                    ->get();
            $postWithAuthor = Post::with('users')
                    ->whereRelation('users','username','=', $authorParam)
                    ->get();

            if (isset($kategoriParam)) {
                return view('public.blog.posts',[
                    'posts'         => $postWithKategori,
                    'kategori'      => $kategoriAll,
                    'recentposts'   => $recentPosts
                ]);
            }
            if (isset($authorParam)) {
                return view('public.blog.posts',[
                    'posts'         => $postWithAuthor,
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
                    'kategori'      => $kategoriAll,
                    'recentposts'   => $recentPosts
                ]);

            }else{
                /* TAMPIL SEMUA POST (DEFAULT TAMPILAN HALAMAN BLOG)*/
                $posts = Post::with('users')->latest('id')->paginate(3);
                
                return view('public.blog.posts',[
                    'title'         => 'Blog '. env('APP_NAME'),
                    'kategori'      => $kategoriAll,
                    'posts'         => $posts,
                    'recentposts'   => $recentPosts
                ]);
            }
        }
    }
}
