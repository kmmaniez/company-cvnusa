<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        for ($i=1; $i <= 6; $i++) { 

            try {
                Service::create([
                    'title' => 'Judul Service Ke-'.$i,
                    'description' => fake()->paragraph('2')
                ]);

            } catch (\Throwable $th) {
                //throw $th;
            }

        }
    }
}
