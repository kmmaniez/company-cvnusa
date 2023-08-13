<?php

namespace App\Http\Controllers;

use App\Models\Team\Anggota;
use App\Models\Carousel;
use App\Models\Clients;
use App\Models\Kategori;
use App\Models\Price;
use App\Models\Project\Project;
use App\Models\Service;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function __construct()
    {
        
    }

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
            'data' => WebsiteSetting::all(),
            'teams' => Anggota::all()
        ]);
    }

    public function pricing()
    {
        return view('public.pricing',[
            'title' => 'Harga',
            'prices' => Price::all()
        ]);
    }

    public function services()
    {
        return view('public.services',[
            'services' => Service::all()
        ]);
    }

    public function testimonials()
    {
        return view('public.testimonials',[
            'data' => Clients::all()
        ]);
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function projects(Request $request)
    {
        if ($request->has('lists')) {
            // echo 'projectss';
        }
        return view('public.projects',[
            // 'kategoris' => Kategor::all(),
            'req' => $request
        ]);
    }

    public function project_details()
    {
        return view('public.projects-single');
    }
}
