<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\KategoriRequest;
use App\Models\Blog\KategoriPost;
use Illuminate\Http\Request;

class KategoriPostController extends Controller
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
    public function store(KategoriRequest $request)
    {
        $data = KategoriPost::create($request->all());
        if ($data) {
            return response()->json([
                'message' => 'Data created successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriPost $kategoriPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriPost $kategoriPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriPost $kategoriPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriPost $kategoriPost)
    {
        $data = $kategoriPost->delete();
        if ($data) {
            return response()->json([
                'message' => 'Data deleted successfully'
                // 'message' => $kategoriBlog
            ]);
        }
    }
}