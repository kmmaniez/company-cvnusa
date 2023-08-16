<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\KategoriJabatanRequest;
use App\Models\Team\KategoriJabatan;
use Illuminate\Http\Request;

class KategoriJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(KategoriJabatanRequest $request)
    {
        try {
            KategoriJabatan::create($request->all());
            return response()->json([
                'messages' => 'Data Created Successfully',
                'data' => $request->all(),
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriJabatan $kategoriJabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriJabatan $kategoriJabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriJabatan $kategoriJabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriJabatan $kategoriJabatan)
    {
        //
    }
}
