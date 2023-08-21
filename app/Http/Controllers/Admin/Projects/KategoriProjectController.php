<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriProjectRequest;
use App\Models\Project\KategoriProject;
use Illuminate\Http\Request;

class KategoriProjectController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        // 
    }

    public function store(KategoriProjectRequest $request)
    {
        if ($request->ajax()) {
            $res = KategoriProject::create($request->all());
            if ($res) {
                return response()->json([
                    'message' => 'Data Created Successfully',
                    'status' => 201
                ]);
            }
        }
        abort(404);
    }

    public function show($kategoriProject)
    {
        if (request()->ajax()) {
            $data = KategoriProject::findOrFail($kategoriProject);
            return response()->json([
                'data' => $data
            ]);
        }
        abort(404);
    }

    public function edit(KategoriProject $kategoriProject)
    {
        //
    }

    public function update(Request $request, $kategoriProject)
    {
        if ($request->ajax()) {
            $data = KategoriProject::findOrfail($kategoriProject);
            if ($data) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Updated Successfully',
                ]);
            }
        }
        abort(404);
    }

    public function destroy($kategoriProject)
    {
        $data = KategoriProject::findOrfail($kategoriProject);
        if ($data) {
            $data->delete();
            return response()->json([
                'message' => 'Data Deleted Successfully',
                'status' => 200
            ]);
        }
    }
}
