<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tagline_title',
        'tagline_content',
        'title_vision',
        'content_vision',
        'title_mission',
        'content_mission',
    ];
}
