<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\CarouselRequest;
use App\Models\Carousel;
use App\Models\Wallpaper;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class WebsiteSettingController extends Controller
{
    private $_website, $_wallpaper;

    public function __construct(WebsiteSetting $websiteSetting, Wallpaper $wallpaper)
    {
        $this->_website = $websiteSetting;
        $this->_wallpaper = $wallpaper;
    }
    
    /* FUNGSI VIEWS HALAMAN ABOUT US */
    public function index()
    {
        return view('admin.web.about', [
            'title'     => 'About Us Settings',
            'jmlhdata'  => $this->_website->count(),
            'data'      => $this->_website->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->_website->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(WebsiteSetting $websiteSetting)
    {
        //
    }

    /* FUNGSI UPDATE ABOUT US */
    public function update(Request $request, $id)
    {
        $data = $this->_website->firstWhere('id',$id);
        $data->update($request->except('aboutid'));
        return redirect()->back();
    }
    
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }

}
