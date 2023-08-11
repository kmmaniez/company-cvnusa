<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.team.index',[
            'title' => 'Teams',
            'teams' => Anggota::all(),
            'jabatans' => Jabatan::all()
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
            $imageName = time().'.'.$request->foto_anggota->extension();  
            $request->foto_anggota->move(public_path('photos/teams'), $imageName);

            $data = Anggota::create([
                ...$request->all(),
                'jabatan_id' => $request->jabatan,
                'gambar_anggota' => $imageName,
            ]);

            return response()->json([
                'message' => 'with image',
                'data' => $request->all(),
                'datas' => $data,
            ]);
        }

        $data = Anggota::create($request->all());

        if ($data) {
            return response()->json([
                'message' => 'success',
                'data' => $request->all(),
                'datas' => $data,
            ]);
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
