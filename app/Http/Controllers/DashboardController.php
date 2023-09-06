<?php

namespace App\Http\Controllers;

use App\Models\Blog\KategoriPost;
use App\Models\Blog\Post;
use App\Models\Clients;
use App\Models\Project\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard',[
            'totalpost'     => Post::all()->count(),
            'totalkatpost'  => KategoriPost::all()->count(),
            'totaluser'     => User::all()->count(),
            'totalclient'   => Clients::all()->count(),
            'totalproject'  => Project::all()->count(),
        ]);
    }
}
