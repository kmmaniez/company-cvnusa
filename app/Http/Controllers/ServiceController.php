<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{

    public function index()
    {
        return view('admin.service.index',[
            'title' => 'Service',
            'data' => Service::all()
        ]);
    }

    public function create()
    {
        //
    }
    
    /* FUNGSI TAMBAH SERVICE */
    public function store(Request $request)
    {
        $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->nama_service)).'.'.$request->gambar_service->extension();
        $pathName = Storage::putFileAs('public/services', $request->file('gambar_service'), $imgName);

        $data = Service::create([
            'title' => $request->nama_service,
            'gambar' => $pathName,
            'description' => $request->description,
        ]);
        

        return response()->json([
            'data' => $data,
            'message' => 'Data created successfully'
        ]);
    }

    /* FUNGSI GET SERVICE BY ID */
    public function show($service)
    {
        $data = Service::findOrfail($service);
        return response()->json([
            'data' => $data
        ]);
    }

    /* FUNGSI UPDATE SERVICE */
    public function update(Request $request, $service)
    {
        if ($request->ajax()) {
            $service = Service::findOrfail($service);
            if ($request->has('gambar_service')) {

                if ($service->gambar != NULL) {
                    Storage::delete($service->gambar); // HAPUS FOTO LAMA
                }

                $imgName = date('His_dmY').'_'.strtolower($request->nama_service).'.'.$request->gambar_service->extension();
                $pathName = Storage::putFileAs('public/services', $request->file('gambar_service'), $imgName);
                
                $data = $service->update([
                    'title' => $request->nama_service,
                    'gambar' => $pathName,
                    'description' => $request->description,
                ]);

                if ($data) {
                    return response()->json([
                        'data' => $service,
                        'message' => 'Data successfully changed',
                        'req' => $request->all()
                    ]);
                }
            }
        }
    }

    /* FUNGSI HAPUS SERVICE */
    public function destroy($service)
    {
        $data = Service::findOrfail($service);
        if ($data) {
            if ($data->logo) {
                Storage::delete($data->logo);
            }
            $data->delete();
            return response()->json([
                'message'   => 'Data Berhasil dihapus',
            ]);
        }
    }
}
