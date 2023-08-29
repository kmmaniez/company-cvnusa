<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPost extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kategori'];
    
    public function posts()
    {
        return $this->hasMany(Post::class, 'kategoripost_id');
    }
}
