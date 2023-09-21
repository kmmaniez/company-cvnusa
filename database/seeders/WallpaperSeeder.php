<?php

namespace Database\Seeders;

use App\Models\Website\Wallpaper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WallpaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['about','projects','pricing','services','clients','contact'];
        
        foreach ($data as $menu) {
            try {
                Wallpaper::create([
                    'section_name' => $menu,
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}
