<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /* FUNGSI VIEWS HALAMAN ABOUT US */
    public function index()
    {
        return view('admin.web.about', [
            'title'     => 'About Us Settings',
            'jmlhdata'  => WebsiteSetting::count(),
            'data'      => WebsiteSetting::all(),
        ]);
    }

    /* FUNGSI SIMPAN ABOUT US */
    public function store(Request $request)
    {
        WebsiteSetting::create($request->all());
        return redirect()->back();
    }

    /* FUNGSI UPDATE ABOUT US */
    public function update(Request $request, $id)
    {
        $data = WebsiteSetting::firstWhere('id',$id);
        $data->update($request->except('aboutid'));
        return redirect()->back();
    }
}
