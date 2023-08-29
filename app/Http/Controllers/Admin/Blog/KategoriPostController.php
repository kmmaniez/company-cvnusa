<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\KategoriRequest;
use App\Models\Blog\KategoriPost;
use Illuminate\Http\Request;

class KategoriPostController extends Controller
{

    public function index()
    {
        return 'hi';
    }
    /* FUNGSI TAMBAH DATA */
    public function store(KategoriRequest $request)
    {
        $data = KategoriPost::create($request->all());
        if ($data) {
            return $this->sendResponse([],'created',201);
        }
    }

    /* FUNGSI MENAMPILKAN DATA BY ID */
    public function show(KategoriPost $kategori)
    {
        return response()->json([
            'data' => $kategori
        ]);
    }

    /* FUNGSI UPDATE DATA */
    public function update(Request $request, KategoriPost $kategoriPost)
    {
        // if ($request->ajax()) {
            $update = $kategoriPost->update([
                'nama_kategori' => $request->nama_kategori
            ]);
            if ($update) {
                return $this->sendResponse(['kat' => $update],'updated',201);
            }
        // }
        // abort(404);
    }

    /* FUNGSI HAPUS DATA */
    public function destroy(KategoriPost $kategoriPost)
    {
        $data = $kategoriPost->delete();
        if ($data) {
            return $this->sendResponse([],'deleted',201);
        }
    }
}
