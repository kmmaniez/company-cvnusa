<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\InformasiRequest;
use App\Models\Website\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.web.informasi', [
            'title'     => 'Informasi Website',
            'data' => Informasi::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InformasiRequest $request)
    {
        // dd($request->all());
        if ($request->has('logo')) {
            $imgName = $request->logo->getClientOriginalName();
            $pathName = Storage::putFileAs('public/company', $request->file('logo'), $imgName);

            Informasi::create([
                'email'         => $request->email,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
                'tentang_kami'  => $request->tentang,
                'logo'          => $pathName,
                'facebook'      => $request->facebook,
                'instagram'     => $request->instagram,
                'twitter'       => $request->twitter,
                'linkedin'      => $request->linkedin,
            ]);
        } else {
            Informasi::create([
                'email'         => $request->email,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
                'tentang_kami'  => $request->tentang,
                'facebook'      => $request->facebook,
                'instagram'     => $request->instagram,
                'twitter'       => $request->twitter,
                'linkedin'      => $request->linkedin,
            ]);
        }
        return redirect()->to(route('informasi.index'))->with('success', 'Data Berhasil Ditambah');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InformasiRequest $request, Informasi $informasi)
    {
        if ($request->has('logo')) {

            if ($informasi->logo != NULL) {
                Storage::delete($informasi->logo); // HAPUS FOTO LAMA
            }

            $imgName = $request->logo->getClientOriginalName();
            $pathName = Storage::putFileAs('public/company', $request->file('logo'), $imgName);

            $informasi->update([
                'email'         => $request->email,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
                'tentang_kami'  => $request->tentang,
                'logo'          => $pathName,
                'facebook'      => $request->facebook,
                'instagram'     => $request->instagram,
                'twitter'       => $request->twitter,
                'linkedin'      => $request->linkedin,
            ]);
        } else {
            $informasi->update([
                'email'         => $request->email,
                'telepon'       => $request->telepon,
                'alamat'        => $request->alamat,
                'tentang_kami'  => $request->tentang,
                'facebook'      => $request->facebook,
                'instagram'     => $request->instagram,
                'twitter'       => $request->twitter,
                'linkedin'      => $request->linkedin,

            ]);
        }
        return redirect()->to(route('informasi.index'))->with('success','Data Berhasil Diubah');

    }
}
