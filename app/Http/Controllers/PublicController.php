<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index');
    }
    
    public function about()
    {
        return view('public.about');
    }

    public function pricing()
    {
        return view('public.pricing');
    }

    public function services()
    {
        return view('public.services');
    }

    public function testimonial()
    {
        return view('public.testimonial');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function project_details()
    {
        return view('public.projects-single');
    }
}
