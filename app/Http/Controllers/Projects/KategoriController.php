<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class KategoriController extends Controller
{

    public function index()
    {
        return view('admin.category.index', [
            'title' => 'Kategori & Projects',
            'kategori' => Kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        $res = Kategori::create($request->all());
        if ($res) {
            # code...
            return response()->json([
                'data' => $request->all(),
                'message' => 'Data Created Successfully',
                'status' => 201
            ]);
        }
    }

    public function show(Kategori $kategori)
    {
        // $data = Kategori::findOrFail($id);
        return response()->json([
            'data' => $kategori
        ]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        // $ea = Kategori::findOrFail($request->id);
        $data = $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);
        return response()->json([
            'data' => $request->all(),
            'ea' => $data
        ]);
    }

    public function destroy(Kategori $kategori)
    {
        $data = $kategori->delete();
        if ($data) {
            return response()->json([
                'message' => 'Data Deleted Successfully',
                'status' => 200
            ]);
        }
    }
}
