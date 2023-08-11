<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $with = ['jabatans'];

    // public function jabatans()
    // {
    //     return $this->hasMany(Jabatan::class,'id');
    // }
}
