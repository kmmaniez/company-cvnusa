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

    /* FUNGI VIEWS HALAMAN WALLPAPER */
    public function indexWallpaper()
    {
        return view('admin.web.wallpaper', [
            'title' => 'Wallpaper Image',
            'data' => $this->_wallpaper->all()
        ]);
    }

    /* FUNGSI GET ALL WALLPAPER DATATABLES */
    public function getAllWallpaper(Request $request)
    {
        if ($request->ajax()) {
            $model = Wallpaper::all();
    
            return DataTables::of($model)
                        ->editColumn('section_name', function($row){
                            $str = '<strong>'.strtoupper($row->section_name).'</strong>';
                            return $str;
                        })
                        ->editColumn('wallpaper_image', function($row){
                            return view('admin.web.wallpaperdt', [
                                'images' => $row->wallpaper_image
                            ]);
                        })
                        ->editColumn('action', function($row){
                            $btn = '
                            <a href="#" id="btnEditWallpaper" data-wall="'.$row->id.'" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            ';
                            return $btn;
                        })
                        ->rawColumns(['section_name','action'])
                        ->toJson();
        }
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

    public function showWallpaperById($wallpaper)
    {
        $web = $this->_wallpaper->find($wallpaper);
        return response()->json([
            'data' => $web
        ]);
    }


    /* FUNGSI UPDATE ABOUT US */
    public function update(Request $request, $id)
    {
        $data = $this->_website->firstWhere('id',$id);
        $data->update($request->except('aboutid'));
        return redirect()->back();
    }

    /* FUNGSI UPDATE WALLPAPER */
    public function updateWallpaper(Request $request, $id)
    {
        
        if ($request->ajax()) {
            $data = $this->_wallpaper->firstWhere('id', $id);
            if ($request->has('wallpaper_image')) {

                if ($data->wallpaper_image != NULL) {
                    Storage::delete($data->wallpaper_image); // HAPUS FOTO LAMA
                }

                $imgName = date('His_dmY').'-'.strtolower($data->section_name).'.'.$request->wallpaper_image->extension();
                $pathName = Storage::putFileAs('public/wallpaper', $request->file('wallpaper_image'), $imgName);
                
                $data = $data->update([
                    'wallpaper_image' => $pathName
                ]);

                if ($data) {
                    return response()->json([
                        'data' => $data,
                        'messages' => 'Data successfully changed',
                        'req' => $request
                    ]);
                }
            }
        }
    }
    
    public function destroy(WebsiteSetting $websiteSetting)
    {
        //
    }

}
