<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class WallpaperController extends Controller
{

    /* FUNGI VIEWS HALAMAN WALLPAPER */
    public function index()
    {
        return view('admin.web.wallpaper', [
            'title' => 'Wallpaper Image',
            'data' => Wallpaper::all()
        ]);
    }

    /* FUNGSI GET ALL WALLPAPER DATATABLES */
    public function getAllWallpaper(Request $request)
    {
        if ($request->ajax()) {
            $model = Wallpaper::all();

            return DataTables::of($model)
                ->editColumn('section_name', function ($row) {
                    $str = '<strong>' . strtoupper($row->section_name) . '</strong>';
                    return $str;
                })
                ->editColumn('wallpaper_image', function ($row) {
                    return view('admin.web.wallpaperdt', [
                        'images' => $row->wallpaper_image
                    ]);
                })
                ->editColumn('action', function ($row) {
                    $btn = '
                            <a href="#" id="btnEditWallpaper" data-wall="' . $row->id . '" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                            ';
                    return $btn;
                })
                ->rawColumns(['section_name', 'action'])
                ->toJson();
        }
    }

    public function show($wallpaper)
    {
        $web = Wallpaper::findOrfail($wallpaper);
        return response()->json([
            'data' => $web
        ]);
    }

    /* FUNGSI UPDATE WALLPAPER */
    public function update(Request $request, $id)
    {

        if ($request->ajax()) {
            // $data = $this->_wallpaper->firstWhere('id', $id);
            $data = Wallpaper::findOrfail($id);
            if ($request->has('wallpaper_image')) {

                if ($data->wallpaper_image != NULL) {
                    Storage::delete($data->wallpaper_image); // HAPUS FOTO LAMA
                }

                $imgName = date('His_dmY') . '-' . strtolower($data->section_name) . '.' . $request->wallpaper_image->extension();
                $pathName = Storage::putFileAs('public/wallpaper', $request->file('wallpaper_image'), $imgName);

                $data = $data->update([
                    'wallpaper_image' => $pathName
                ]);

                if ($data) {
                    return response()->json([
                        'data' => $data,
                        'message' => 'Data successfully changed',
                        'req' => $request
                    ]);
                }
            }
        }
    }
}
