<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Jabatan;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Testing\Fakes\Fake;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');
        $jabatan = ['CEO','CTO','Manager','Accountant','Marketing'];
        
        for ($i=0; $i < count($jabatan); $i++) { 
            Jabatan::create(['nama_jabatan' => $jabatan[$i]]);
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
