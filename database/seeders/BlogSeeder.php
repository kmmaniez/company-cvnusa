<?php

namespace Database\Seeders;

use App\Models\Blog\Blog;
use App\Models\Blog\KategoriBlog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Bangunan','Arsitektur','Desain','Minimalis','Modern'];

        foreach ($kategori as $nama) {
            KategoriBlog::create(['nama_kategori' => $nama]);
        }

        for ($i=0; $i < 10; $i++) { 
            Blog::create([
                'category_id' => rand(1,5),
                'user_id' => rand(1,8),
                'title' => fake()->text('20'),
                'slug' => fake()->text('20'),
                'content' => fake()->paragraph('5')
            ]);
        }

        
    }
}
