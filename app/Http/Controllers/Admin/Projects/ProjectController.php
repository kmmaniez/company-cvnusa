<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project\KategoriProject;
use App\Models\Project\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /* FUNGSI VIEWS INDEX PROJECT */
    public function index()
    {
        return view('admin.project.index',[
            'title' => 'Projects',
            'kategori' => KategoriProject::all(),
            'projects' => Project::all()
        ]);
    }


    /* FUNGSI TAMBAH PROJECT */
    public function store(Request $request)
    {
        // dd($request->all());
        $image = [];
        foreach ($request->file('gambar_project') as $key => $value) {
            // $image[$key] = $value->getClientOriginalName();
            array_push($image,$request->file('gambar_project')[$key]->getClientOriginalName());
            // array_push($image,$value->getClientOriginalName());
        }
        return response()->json([
            'file' => $request->file('gambar_project')->getClientOriginalName(),
            'data' => $image,
            // 'message' => 'Data Created Successfully',
            // 'status' => 201
        ]);
    }

    /* FUNGSI LIHAT DATA PROJECT */
    public function show(Project $project)
    {
        //
    }

    /* FUNGSI TAMBAH PROJECT */
    public function edit(Project $project)
    {
        //
    }

    /* FUNGSI UPDATE PROJECT */
    public function update(Request $request, Project $project)
    {
        //
    }

    /* FUNGSI HAPUS PROJECT */
    public function destroy(Project $project)
    {
        //
    }
}
