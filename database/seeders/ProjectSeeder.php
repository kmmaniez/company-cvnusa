<?php

namespace Database\Seeders;

use App\Models\Project\KategoriProject;
use App\Models\Project\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');
        $kategori = ['Interior','Arsitektur','Minimalis','Gedung','Desain'];

        foreach ($kategori as $data) {
            KategoriProject::create(['nama_kategori' => $data]);
        }

        for ($i=0; $i < 10; $i++) { 
            Project::create([
                'kategori_id' => rand(1,5),
                'nama_project' => $faker->text('10'),
                'slug' => str_replace(' ','-',fake()->text('20')),
                'keterangan_project' => $faker->paragraph('2'),
                'start_date' => $faker->date(),
                'finish_date' => $faker->date(),
            ]);
        }
    }
}
