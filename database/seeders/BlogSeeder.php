<?php

namespace Database\Seeders;

use App\Models\Blog\Blog;
use App\Models\Blog\KategoriBlog;
use App\Models\Blog\KategoriPost;
use App\Models\Blog\Post;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* 
            SEEDER KHUSUS BLOG 
            (KATEGORI POST & POST)
        */
        $kategori = ['Bangunan','Arsitektur','Desain','Minimalis','Modern'];

        foreach ($kategori as $nama) {
            KategoriPost::create(['nama_kategori' => $nama]);
        }

        for ($i=0; $i < 10; $i++) { 
            Post::create([
                'kategoripost_id' => rand(1,5),
                'user_id' => rand(1,8),
                'title' => fake()->text('20'),
                'slug' => str_replace(' ','-',fake()->text('20')),
                'content' => fake()->paragraph('5')
            ]);
        }

        
    }
}
