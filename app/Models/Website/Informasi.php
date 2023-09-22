<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'logo',
        'email',
        'tentang_kami',
        'telepon',
        'alamat',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        
    ];

    public $timestamps = false;
}
