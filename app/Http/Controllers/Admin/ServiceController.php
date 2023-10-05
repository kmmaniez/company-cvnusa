<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
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
    public function store(ServiceRequest $request)
    {
        if ($request->hasFile('gambar_service')) {
            $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->nama_service)).'.'.$request->gambar_service->extension();
            $pathName = Storage::putFileAs('public/services', $request->file('gambar_service'), $imgName);
    
            $data = Service::create([
                'title' => $request->nama_service,
                'gambar' => $pathName,
                'description' => $request->description_service,
            ]);
            
        }else{
            $data = Service::create([
                'title' => $request->nama_service,
                'description' => $request->description_service,
            ]);
        }
        

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
                
                $service->update([
                    'title' => $request->nama_service,
                    'gambar' => $pathName,
                    'description' => $request->description_service,
                ]);

                return $this->successResponse([],'updated');
            }else{
                $service->update([
                    'title' => $request->nama_service,
                    'description' => $request->description_service,
                ]);
                return $this->successResponse([],'updated');
            }
        }
    }

    /* FUNGSI HAPUS SERVICE */
    public function destroy($service)
    {
        $data = Service::findOrfail($service);
        if ($data) {
            if ($data->gambar) {
                Storage::delete($data->gambar);
            }
            $data->delete();

            return $this->successResponse([],'deleted');
        }
    }
}
