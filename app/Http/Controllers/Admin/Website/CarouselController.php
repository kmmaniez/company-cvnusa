<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\CarouselRequest;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{

    /* FUNGSI VIEWS HALAMAN CAROUSEL */
    public function index()
    {
        echo strtolower(str_replace(' ','-','When Service Matters'));
        return view('admin.web.carousel', [
            'title' => 'Carousel Image',
            'carousels' => Carousel::all(),
        ]);
    }

    /* FUNGSI UNTUK UPDATE CAROUSEL */
    public function store(CarouselRequest $request)
    {
        if ($request->has('gambar_carousel')) {
            $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->slide_title)).'.'.$request->gambar_carousel->extension();
            $pathName = Storage::putFileAs('public/carousels', $request->file('gambar_carousel'), $imgName);
            
            $data = Carousel::create([
                ...$request->all(),
                'image' => $pathName
            ]);

            if ($data) {
                return response()->json([
                   'message' => 'Data created successfully'
                ]);
            }
        }
    }

    /* FUNGSI UNTUK LIHAT DATA CAROUSEL */
    public function show($carousels)
    {
        $data = Carousel::findOrfail($carousels);
        return response()->json([
            'data' => $data
        ]);
    }

    /* FUNGSI UNTUK UPDATE CAROUSEL */
    public function update(Request $request, $carousels)
    {
        if ($request->ajax()) {
            
            $data = Carousel::findOrfail($carousels);
            if ($request->has('gambar_carousel')) {

                if ($data->gambar_carousel != NULL) {
                    Storage::delete($data->gambar_carousel); // HAPUS FOTO LAMA
                }

                $imgName = date('His_dmY').'-'.strtolower(str_replace(' ','_',$data->slide_title)).'.'.$request->gambar_carousel->extension();
                $pathName = Storage::putFileAs('public/carousels', $request->file('gambar_carousel'), $imgName);
                
                $update = $data->update([
                    ...$request->all(),
                    'image' => $pathName
                ]);

                if ($update) {
                    return response()->json([
                        'message' => 'Data successfully changed',
                    ]);
                }
            }
        }
    }

    /* FUNGSI UNTUK HAPUS CAROUSEL */
    public function destroy($carousels)
    {
        $data = Carousel::findOrfail($carousels);
        if ($data) {
            if ($data->image) {
                Storage::delete($data->image);
            }
            $data->delete();
            return response()->json([
                'message'   => 'Data Berhasil dihapus',
            ]);
        }
    }
}
