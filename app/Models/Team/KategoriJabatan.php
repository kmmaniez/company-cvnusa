<?php

namespace App\Models;
namespace App\Models\Team;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJabatan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jabatan'];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class,'jabatan_id');
    }
}
