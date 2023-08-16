<?php

namespace App\Models\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['jabatans'];

    public function jabatans()
    {
        return $this->belongsTo(KategoriJabatan::class,'jabatan_id');
    }
}
