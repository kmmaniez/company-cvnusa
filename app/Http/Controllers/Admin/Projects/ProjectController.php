<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ProjectRequest;
use App\Models\Project\KategoriProject;
use App\Models\Project\Project;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /* FUNGSI VIEWS INDEX PROJECT */
    public function index()
    {
        return view('admin.project.index', [
            'title' => 'Projects',
            'kategori' => KategoriProject::all(),
            'projects' => Project::all()
        ]);
        // return $this->successResponse(null,'updated');
    }

    public function create()
    {
        return view('admin.project.create', [
            'title' => 'Create Projects'
        ]);
    }

    /* FUNGSI TAMBAH PROJECT */
    public function store(ProjectRequest $request)
    {
        $newFolderProject = $request->slug_project;
        $listPathImage = array();

        if ($request->hasFile('gambar_project') || $request->hasFile('thumbnail')) {

            try {
                // SIMPAN FOTO THUMBNAIL KE STORAGE 
                $thumbnailPathName = Storage::putFileAs(
                    'public/projects/' . $newFolderProject,
                    $request->file('thumbnail'),
                    $request->thumbnail->getClientOriginalName()
                );
                // array_push($listPathImage, $thumbnailPathName);

                // SIMPAN FOTO PROJECTS KE STORAGE 
                if ($request->hasFile('gambar_project')) {
                    foreach ($request->file('gambar_project') as $key => $value) {
                        // LOOPING & PUSH NAMA FILE KE ARRAY
                        array_push(
                            $listPathImage,
                            Storage::putFileAs(
                                'public/projects/' . $newFolderProject,
                                $request->file('gambar_project')[$key],
                                $value->getClientOriginalName()
                            )
                        );
                    }
                }
                Project::create([
                    'kategori_id'           => rand(1, 5),
                    'nama_project'          => $request->nama_project,
                    'slug'                  => $request->slug_project,
                    'keterangan_project'    => $request->keterangan_project,
                    'start_date'            => $request->start_date,
                    'finish_date'           => $request->finish_date,
                    'thumbnail'             => $thumbnailPathName,
                    'gambar_project'        => json_encode($listPathImage) // SEMUA PATH GAMBAR JADI 1
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        return redirect()->to(route('projects.index'))->with('success', 'Data berhasil ditambahkan');
    }

    /* FUNGSI LIHAT DATA PROJECT */
    public function show(Project $project)
    {
        dump($project);
    }

    /* FUNGSI TAMBAH PROJECT */
    public function edit(Project $project)
    {
        return view('admin.project.edit', [
            'title' => 'Edit Projects',
            'data' => $project
        ]);
    }

    /* FUNGSI UPDATE PROJECT */
    public function update(Request $request, Project $project)
    {
        $oldFolder = $project->slug;
        $newFolderProject = $request->slug_project;
        $replacePathThumbnailLama = str_replace('public/projects/'.$project->slug.'/', '', $project->thumbnail);
        $listPathImage = array();

        if ($request->hasFile('thumbnail') && $request->hasFile('gambar_project')) {
            // DELETE THUMBNAIL LAMA
            Storage::delete($project->thumbnail);
            // SIMPAN FOTO THUMBNAIL KE STORAGE 
            $thumbnailPathName = Storage::putFileAs(
                'public/projects/' . $newFolderProject,
                $request->file('thumbnail'),
                $request->thumbnail->getClientOriginalName()
            );
            array_push($listPathImage, $thumbnailPathName); // SIMPAN NAMA PATH THUMBNAIL

            // SIMPAN FOTO PROJECTS KE STORAGE 
            if ($request->hasFile('gambar_project')) {
                foreach ($request->file('gambar_project') as $key => $value) {
                    // LOOPING & PUSH NAMA PATH KE ARRAY
                    array_push(
                        $listPathImage,
                        Storage::putFileAs(
                            'public/projects/' . $newFolderProject,
                            $request->file('gambar_project')[$key],
                            $value->getClientOriginalName()
                        )
                    );
                }
            }
            $project->update([
                'kategori_id'           => rand(1, 5),
                'nama_project'          => $request->nama_project,
                'slug'                  => $request->slug_project,
                'keterangan_project'    => $request->keterangan_project,
                'start_date'            => $request->start_date,
                'finish_date'           => $request->finish_date,
                'thumbnail'             => $thumbnailPathName,
                'gambar_project'        => json_encode($listPathImage) // SEMUA PATH GAMBAR JADI 1
            ]);
        } else {
            if ($request->thumbnail) {
                // update only thumbnail

                // cek nama project berubah
                if (!Storage::directoryExists('public/projects/'. $newFolderProject)) {
                    Storage::makeDirectory('public/projects/'. $newFolderProject);
                    $listPathImage = self::ChangePathImageFolder(
                        $project->slug, 
                        $newFolderProject, 
                        $project->gambar_project
                    );
                }

                // cek isi array gambar
                if (count($listPathImage) > 0) {
                    $newPathThumbnail = Storage::putFileAs(
                        'public/projects/' . $newFolderProject,
                        $request->file('thumbnail'),
                        $request->thumbnail->getClientOriginalName()
                    );

                    Storage::deleteDirectory('public/projects/'. $oldFolder); // DELETE FOLDER LAMA
                    $project->update([
                        'kategori_id'           => rand(1, 5),
                        'nama_project'          => $request->nama_project,
                        'slug'                  => $request->slug_project,
                        'keterangan_project'    => $request->keterangan_project,
                        'start_date'            => $request->start_date,
                        'finish_date'           => $request->finish_date,
                        'thumbnail'             => $newPathThumbnail,
                        'gambar_project'        => json_encode($listPathImage),
                    ]);
                }else{
                    Storage::delete($project->thumbnail); // DELETE FILE LAMA
                    $thumbnailPathName = Storage::putFileAs(
                        'public/projects/' . $newFolderProject,
                        $request->file('thumbnail'),
                        $request->thumbnail->getClientOriginalName()
                    );
                    $project->update([
                        'kategori_id'           => rand(1, 5),
                        'nama_project'          => $request->nama_project,
                        'slug'                  => $request->slug_project,
                        'keterangan_project'    => $request->keterangan_project,
                        'start_date'            => $request->start_date,
                        'finish_date'           => $request->finish_date,
                        'thumbnail'             => $thumbnailPathName,
                    ]);
                }
                

            } else if ($request->gambar_project) {
                // Update only gambar
                // cek nama project berubah ? jika berubah buat folder baru
                if (!Storage::directoryExists('public/projects/'. $newFolderProject)) {
                    Storage::makeDirectory('public/projects/'. $newFolderProject);
                
                    $allPathImages = self::ChangePathImageFolder(
                        $project->slug, 
                        $newFolderProject, 
                        $project->gambar_project
                    );

                    // copy file thumbnail ke folder baru
                    Storage::copy(
                        'public/projects/'.$project->slug.'/'. $replacePathThumbnailLama,
                        'public/projects/'.$newFolderProject.'/'. $replacePathThumbnailLama  
                    );
                    $newPathThumbnail = str_replace($project->slug, $newFolderProject, $project->thumbnail);

                    Storage::deleteDirectory('public/projects/'.$oldFolder); // DELETE FILE LAMA
                    $project->update([
                        'kategori_id'           => rand(1, 5),
                        'nama_project'          => $request->nama_project,
                        'slug'                  => $request->slug_project,
                        'keterangan_project'    => $request->keterangan_project,
                        'start_date'            => $request->start_date,
                        'finish_date'           => $request->finish_date,
                        'thumbnail'             => $newPathThumbnail,
                        'gambar_project'        => json_encode($allPathImages),
                    ]);

                }else{
                    foreach (json_decode($project->gambar_project) as $key => $value) {
                        array_push(
                            $listPathImage,
                            $value,
                        );
                    }
                    foreach ($request->file('gambar_project') as $key => $value) {
                        array_push(
                            $listPathImage,
                            Storage::putFileAs(
                                'public/projects/' . $project->slug,
                                $request->file('gambar_project')[$key],
                                $value->getClientOriginalName()
                            )
                        );
                    }
                    // dump($listPathImage);
                    $project->update([
                        'kategori_id'           => rand(1, 5),
                        'nama_project'          => $request->nama_project,
                        'slug'                  => $request->slug_project,
                        'keterangan_project'    => $request->keterangan_project,
                        'start_date'            => $request->start_date,
                        'finish_date'           => $request->finish_date,
                        'gambar_project'        => json_encode($listPathImage),
                    ]);
                }

            } else {
                // UPDATE TEXT ONLY
                $project->update([
                    'kategori_id'           => rand(1, 5),
                    'nama_project'          => $request->nama_project,
                    'slug'                  => $request->slug_project,
                    'keterangan_project'    => $request->keterangan_project,
                    'start_date'            => $request->start_date,
                    'finish_date'           => $request->finish_date,
                ]);
            }
        }
        dd();

        // return redirect()->back();
        // return redirect()->to(route('projects.index'))->with('success', 'Data berhasil ditambahkan');
    }

    /* FUNGSI HAPUS PROJECT */
    public function destroy(Project $project)
    {
        Storage::deleteDirectory('public/projects/' . $project->slug);
        $project->delete();
        return $this->successResponse([],'Dihapus');
    }

    /* FUNGSI CHECK SLUG POST */
    public function checkSlug()
    {
        $slug = SlugService::createSlug(Project::class, 'slug', request('title'));
        return response()->json(['slug' => $slug]);
    }

    public function deleteAllImages(Request $request, Project $project)
    {
        foreach (json_decode($project->gambar_project) as $key => $value) {
            Storage::delete($value);
        }
        $project->update([
            'gambar_project' => json_encode([])
        ]);
        return response()->json([
            'message' => 'ok',
            'project' => $project
        ]);
    }

    /* FUNGSI GANTI PATH FOLDER SEMUA GAMBAR */
    protected function ChangePathImageFolder($from, $to, $data)
    {
        $pathImage = array();
        foreach (json_decode($data) as $key => $value) {
            // replace path lama ke baru & push ke array
            array_push(
                $pathImage,  
                str_replace($from, $to, $value) // replace path project lama ke baru
            );

            // copy file sebelumnya ke folder baru
            Storage::copy(
                'public/projects/'.$from.'/'.str_replace('public/projects/'.$from.'/', '', $value),
                'public/projects/'.$to.'/'.str_replace('public/projects/'.$from.'/', '', $value)  
            );
        }
        return $pathImage;
    }
}
