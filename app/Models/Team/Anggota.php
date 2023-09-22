<?php

namespace App\Models\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_anggota',
        'jabatan_id',
        'foto_anggota',
        'url_facebook',
        'url_twitter',
        'url_linkedin',
        'url_instagram',
    ];
    protected $with = ['jabatans'];

    public function jabatans()
    {
        return $this->belongsTo(KategoriJabatan::class,'jabatan_id');
    }
}
