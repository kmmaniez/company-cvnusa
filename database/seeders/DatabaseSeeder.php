<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DELETE SEMUA FOLDER & FILE PENYIMPANAN STORAGE
        $allDir = Storage::disk('public')->allDirectories();
        for ($i=0; $i < count($allDir); $i++) { 
            try {
                Storage::disk('public')->deleteDirectory($allDir[$i]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            TeamSeeder::class,
            WallpaperSeeder::class,
            ServiceSeeder::class,
            CarouselSeeder::class,
            BlogSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
