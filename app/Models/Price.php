<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul',
        'harga',
        'keterangan',
        'custom_text_button',
        'is_featured',
    ];
}
