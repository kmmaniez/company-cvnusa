<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Team\Anggota;
use App\Models\Team\KategoriJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.team.index',[
            'title' => 'Teams',
            'teams' => Anggota::with('jabatans')->get(),
            'jabatans' => KategoriJabatan::all()
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
        if ($request->has('foto_anggota')) {
            $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->nama_anggota)).'.'.$request->foto_anggota->extension();
            $pathName = Storage::putFileAs('public/teams', $request->file('foto_anggota'), $imgName);
            try {
                Anggota::create([
                    ...$request->all(),
                    'jabatan_id' => (int) $request->jabatan_id,
                    'foto_anggota' => $pathName,
                ]);

                return response()->json([
                    'message' => 'Data Created Successfully',
                    'data' => $request->all(),
                ]);

            } catch (\Throwable $th) {
                //throw $th;
            }
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        //
    }
}
