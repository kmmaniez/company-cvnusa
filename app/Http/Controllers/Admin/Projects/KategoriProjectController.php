<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\KategoriProjectRequest;
use App\Models\Project\KategoriProject;
use Illuminate\Http\Request;

class KategoriProjectController extends Controller
{
    
    public function index()
    {
        abort(404);
    }

    public function create()
    {
        abort(404);
    }

    public function store(KategoriProjectRequest $request)
    {
        if ($request->ajax()) {
            $created = KategoriProject::create($request->all());
            
            if ($created) {
                return $this->successResponse(null,'created');
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
                return $this->successResponse(null,'updated');
            }
        }
        abort(404);
    }

    public function destroy($kategoriProject)
    {
        $data = KategoriProject::findOrfail($kategoriProject);
        if ($data) {
            $data->delete();
            return $this->successResponse(null,'deleted');
        }
    }
}
