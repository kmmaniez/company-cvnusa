<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Alert;
class DashboardController extends Controller
{
    public function index()
    {
        // toast('Signed in successfully','success')->timerProgressBar();
        return view('admin.dashboard');
    }
}
