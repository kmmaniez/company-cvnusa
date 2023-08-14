<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['kategoris'];

    public function kategoris()
    {
        return $this->belongsTo(KategoriPost::class, 'kategoripost_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
