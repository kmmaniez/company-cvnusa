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
        abort(404);
    }

    public function store(KategoriRequest $request)
    {
        if (request()->ajax()) {
            $data = KategoriPost::create($request->all());
            if ($data) {
                return $this->successResponse(null,'created');
            }
        }
        abort(404);
    }

    public function show(KategoriPost $kategori)
    {
        if (request()->ajax()) {
            return response()->json([
                'data' => $kategori
            ]);
        }
        abort(404);
    }

    public function update(Request $request, KategoriPost $kategoriPost)
    {
        if ($request->ajax()) {
            $update = $kategoriPost->update([
                'nama_kategori' => $request->nama_kategori
            ]);
            if ($update) {
                return $this->successResponse(null,'updated');
            }
        }
        abort(404);
    }

    public function destroy(KategoriPost $kategoriPost)
    {
        $data = $kategoriPost->delete();
        if ($data) {
            return $this->successResponse(null, 'deleted');
        }
    }
}
