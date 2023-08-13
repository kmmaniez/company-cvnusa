<?php

namespace App\Http\Controllers;

use App\Http\Requests\Website\UpdateWallpaperRequest;
use App\Models\Wallpaper;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteSettingController extends Controller
{
    private $_website, $_wallpaper;

    public function __construct(WebsiteSetting $websiteSetting, Wallpaper $wallpaper)
    {
        $this->_website = $websiteSetting;
        $this->_wallpaper = $wallpaper;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.web.about', [
            'title'     => 'About Us Settings',
            'jmlhdata'  => $this->_website->count(),
            'data'      => $this->_website->all(),
        ]);
    }

    public function indexCarousel()
    {
        return view('admin.web.carousel', [
            'title' => 'Carousel Image'
        ]);
    }

    public function indexWallpaper()
    {
        return view('admin.web.wallpaper', [
            'title' => 'Wallpaper Image',
            'data' => $this->_wallpaper->all()
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

    public function showWallpaper($wallpaper)
    {
        $web = $this->_wallpaper->find($wallpaper);
        return response()->json([
            'data' => $web
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WebsiteSetting $websiteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $this->_website->firstWhere('id',$id);
        $data->update($request->except('aboutid'));
        return redirect()->back();
    }

    public function updateWallpaper(Request $request, Wallpaper $wallpaper)
    {
        
        if ($request->ajax()) {
            // $data = $this->_wallpaper->firstWhere('id', $id);

            // if ($request->has('wallpaper_image')) {
                return response()->json([
                    'data' => $wallpaper,
                    'req' => $request->all()
                ]);
                // $imgName = strtolower($wallpaper->section_name).'.'.$request->wallpaper_image->extension();
                // $pathName = Storage::putFileAs('public/wallpaper', $request->file('wallpaper_image'), $imgName);
                
                // $data = $this->_wallpaper->update([
                //     'wallpaper_image' => $pathName
                // ]);

                // if ($data) {
                //     return response()->json([
                //         'data' => $data,
                //         'req' => $request
                //     ]);
                // }
            // }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }
}
