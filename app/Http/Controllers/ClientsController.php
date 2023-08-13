<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.client.index',[
            'title' => 'Clients',
            'data' => Clients::all()
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
    public function store(ClientRequest $request)
    {

        $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->nama_client)).'.'.$request->logo->extension();
        $pathName = Storage::putFileAs('public/clients', $request->file('logo'), $imgName);

        Clients::create([
            'nama' => $request->nama_client,
            'logo' => $pathName,
            'telepon' => $request->telepon_client,
        ]);

        return response()->json([
            'data' => $request->all(),
            'path' => $pathName
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($clients)
    {
        $data = Clients::findOrfail($clients);
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($clients)
    {
        $data = Clients::findOrfail($clients);
        if ($data) {
            Storage::delete($data->logo);
            $data->delete();
            return response()->json([
                'data' => $data,
                'messages' =>'sukses',
            ]);
        }
    }
}
