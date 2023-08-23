<?php

namespace App\Http\Controllers\Admin\Team;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\AnggotaRequest;
use App\Models\Team\Anggota;
use App\Models\Team\KategoriJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /* FUNGSI VIEW ANGGOTA */
    public function index()
    {
        return view('admin.team.index',[
            'title' => 'Teams',
            'teams' => Anggota::with('jabatans')->get(),
            'jabatans' => KategoriJabatan::all()
        ]);
    }

    /* FUNGSI TAMBAH ANGGOTA */
    public function store(AnggotaRequest $request)
    {
        if ($request->ajax()) {
            # code...
            if ($request->has('foto_anggota')) {
                $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->nama_anggota)).'.'.$request->foto_anggota->extension();
                $pathName = Storage::putFileAs('public/teams', $request->file('foto_anggota'), $imgName);
                // try {
                    Anggota::create([
                        ...$request->all(),
                        'jabatan_id' => (int) $request->jabatan_id,
                        'foto_anggota' => $pathName,
                    ]);
    
                    return response()->json([
                        'message' => 'Data Created Successfully',
                        'data' => $request->all(),
                    ]);
    
                // } catch (\Throwable $th) {
                //     //throw $th;
                // }
        }else{
            Anggota::create([
                ...$request->all(),
                'jabatan_id' => (int) $request->jabatan_id,
            ]);

            return response()->json([
                'message' => 'Data Created Successfully',
                'data' => $request->all(),
            ]);
        }
            
        }
    }

    /* FUNGSI LIHAT DATA ANGGOTA */
    public function show($anggota)
    {
        return response()->json([
            'data' => Anggota::findOrfail($anggota)
        ]);
    }

    /* FUNGSI UPDATE ANGGOTA */
    public function update(Request $request, $anggota)
    {
        if ($request->ajax()) {
            $data = Anggota::findOrfail($anggota);

            if ($request->has('foto_anggota')) {

                if ($data->foto_anggota != NULL) {
                    Storage::delete($data->foto_anggota); // HAPUS FOTO LAMA
                }
                
                $imgName = date('His_dmY').'-'.str_replace(' ','_',strtolower($request->nama_anggota)).'.'.$request->foto_anggota->extension();
                $pathName = Storage::putFileAs('public/teams', $request->file('foto_anggota'), $imgName);
                
                $update = $data->update([
                    ...$request->all(),
                    'jabatan_id' => (int) $request->jabatan_id,
                    'foto_anggota' => $pathName,
                ]);

                if ($update) {
                    return response()->json([
                        'message' => 'Data successfully changed',
                    ]);
                }
            }else{
                $update = $data->update([
                    ...$request->all(),
                    'jabatan_id' => (int) $request->jabatan_id,
                ]);
                if ($update) {
                    return response()->json([
                        'message' => 'Data successfully changed',
                    ]);
                }
            }
        }
    }

    /* FUNGSI HAPUS ANGGOTA */
    public function destroy($anggota)
    {
        $data = Anggota::findOrfail($anggota);
        if ($data) {
            Storage::delete($data->foto_anggota);
            $data->delete();
            return response()->json([
                'data' => $data,
                'message'   => 'Data Berhasil dihapus',
            ]);
        }
    }
}
