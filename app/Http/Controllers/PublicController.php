<?php

namespace App\Http\Controllers;

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
}
