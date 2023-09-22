<?php

namespace App\Models\Project;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'kategori_id',
        'nama_project',
        'slug',
        'keterangan_project',
        'start_date',
        'finish_date',
        'thumbnail',
        'gambar_project',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_project'
            ]
        ];
    }
}
