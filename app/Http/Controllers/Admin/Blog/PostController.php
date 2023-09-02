<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\PostRequest;
use App\Models\Blog\KategoriPost;
use App\Models\Blog\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    
    public function index()
    {
        return view('admin.blog.index', [
            'title' => 'Post'
        ]);
    }

    /* AMBIL SEMUA DATA POST */
    public function getAllPosts(Request $request)
    {
        if ($request->ajax()) {
        $role = Auth::user()->roles[0]; // AMBIL ROLE USER YG LOGIN

        if ($role->name != 'super') {
            // JIKA ROLE USER TIDAK SUPER
            // MENAMPILKAN HANYA DATA YANG DITULIS USER YG LOGIN
            $model = Post::with(['users'])
                        ->whereRelation('users','id','=', auth()->user()->id)
                        ->get();
        }else{
            // JIKA ROLE USER = SUPER
            // MENAMPILKAN SEMUA POSTINGAN USER
            $model = Post::with(['users'])->get();
        }

        return DataTables::of($model)
            ->only(['title','user_id','kategoris','users','slug','thumbnail','updated_at','action'])
            ->addIndexColumn()
            ->editColumn('thumbnail', function ($row) {
                return view('admin.blog.imagedt', [
                    'gambar' => $row->thumbnail
                ]);
            })
            ->editColumn('updated_at', function ($row) {
                return view('admin.blog.datedt', [
                    'created' => $row->created_at,
                    'updated' => $row->updated_at,
                ]);
            })
            ->editColumn('action', function ($row) {
                $url = route('public.post.all');
                $btn = '
                    <a href="'. $url .'/'. $row->slug .'" target="_blank" class="btn btn-md btn-secondary"><i class="fas fa-fw fa-eye"></i> Lihat</a>
                    <a href="posts/' . $row->slug . '/edit" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i> Edit</a>
                    <a href="#" data-post="'.$row->slug.'" id="btnHapusPost" class="btn btn-md btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Delete</a>
                ';
                return $btn;
            })
            ->toJson();
        }
        return abort(404);
    }

    /* FUNGSI VIEW CREATE POST */
    public function create()
    {
        return view('admin.blog.create',[
            'kategori' => KategoriPost::all(),
            'title' => 'Post',
            'title_kat' => 'Kategori Post',
        ]);
    }

    /* FUNGSI TAMBAH POST */
    public function store(PostRequest $request)
    {
        if ($request->has('thumbnail')) {
            $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->title)).'.'.$request->thumbnail->extension();
            $pathName = Storage::putFileAs('public/posts', $request->file('thumbnail'), $imgName);
            
            Post::create([
                ...$request->all(),
                'spoiler_text' => Str::limit(strip_tags($request->content),'200'),
                'user_id'       => $request->user()->id,
                'thumbnail'     => $pathName,
                'created_at'    => Carbon::now(),
                'updated_at'    => NULL,
            ]);

        }else{
            Post::create([
                ...$request->all(),
                'user_id'       => $request->user()->id,
                'spoiler_text' => Str::limit(strip_tags($request->content),'200'),
                'created_at'    => Carbon::now(),
                'updated_at'    => NULL,
            ]);

        }
        return redirect()->to(route('posts.index'))->with('success','Data Created Successfully!');
    }

    /* FUNGSI VIEW EDIT POST */
    public function edit(Post $post)
    {
        // JIKA PENULIS TIDAK SAMA DENGAN USER LOGIN, AKSES DITUTUP
        if (auth()->user()->id != $post->users->id && auth()->user()->roles[0]->name != "super" && auth()->user()->roles[0]->name != "admin") {
            abort(404);
        }

        return view('admin.blog.edit', [
            'title' => 'Edit Blog',
            'title_kat' => 'Kategori Post',
            'kategori' => KategoriPost::all(['id', 'nama_kategori']),
            'blog' => $post
        ]);
    }

    /* FUNGSI UPDATE POST */
    public function update(Request $request, Post $post)
    {
        if ($request->has('thumbnail')) {

            if ($post->thumbnail != NULL) {
                Storage::delete($post->thumbnail); // HAPUS FOTO LAMA
            }

            $imgName = date('HisdmY').'_'.str_replace(' ','_',strtolower($request->title)).'.'.$request->thumbnail->extension();
            $pathName = Storage::putFileAs('public/posts', $request->file('thumbnail'), $imgName);
            
            $post->update([
                ...$request->all(),
                'user_id'       => $request->user()->id,
                'spoiler_text' => Str::limit(strip_tags($request->content),'200'),
                'thumbnail'     => $pathName,
                'created_at'    => $post->created_at,
                'updated_at'    => Carbon::now(),
            ]);
        }else{
            $post->update([
                ...$request->all(),
                'user_id'       => $request->user()->id,
                'spoiler_text' => Str::limit(strip_tags($request->content),'200'),
                'created_at'    => $post->created_at,
                'updated_at'    => Carbon::now(),
            ]);
        }
        return redirect()->to(route('posts.index'))->with('success','Data Updated Successfully!');
    }

    /* FUNGSI HAPUS POST */
    public function destroy(Post $post)
    {
        if (request()->ajax()) {
            if ($post->thumbnail != NULL) {
                Storage::delete($post->thumbnail); // HAPUS FOTO LAMA
            }
            $deleted = $post->delete();
            if ($deleted) {
                return $this->sendResponse([],'deleted',200);
            }
        }
        abort(404);
    }

    /* FUNGSI CHECK SLUG POST */
    public function checkSlug()
    {
        $slug = SlugService::createSlug(Post::class, 'slug', request('title'));
        return response()->json(['slug' => $slug]);
    }
}
