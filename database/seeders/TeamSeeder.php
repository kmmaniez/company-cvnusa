<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Team\Anggota;
use App\Models\Team\KategoriJabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');
        $jabatan = ['CEO','CTO','Manager','Accountant','Marketing','Supervisor'];
        
        for ($i=0; $i < count($jabatan); $i++) { 
            KategoriJabatan::create(['nama_jabatan' => $jabatan[$i]]);
        }

        for ($i=0; $i < 5; $i++) { 
            try {
                Anggota::create([
                        'nama_anggota'  => $faker->name(),
                        'jabatan_id'    =>  $i + 1,
                        'url_facebook'  => 'https://fb.com/jajajaj',
                        'url_twitter'   => '@elonmusk',
                        'url_linkedin'  => 'https://linkedin.com/jajaja',
                        'url_instagram' => '@instagram',
                ]);
            } catch (\Throwable $th) {
                // throw $th;
            }
        }
    }
}
