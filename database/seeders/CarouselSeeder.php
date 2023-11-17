<?php

namespace Database\Seeders;

use App\Models\Website\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'slide_title' => '17 Years of excellence in',
                'slide_subtitle'=> 'Construction Industry',
                'description' => 'We will deal with your failure that determines how you achieve success.',
            ],
            [
                'slide_title' => 'When Service Matters',
                'slide_subtitle'=> 'Your Choice is Simple',
                'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, qui?.',
            ],
            [
                'slide_title' => 'Meet Our Engineers',
                'slide_subtitle'=> 'We believe sustainability',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel placeat quibusdam culpa adipisci.',
            ],
        ];
        foreach ($data as $row) {
            try {
                Carousel::create([
                    'slide_title'   => $row['slide_title'],
                    'slide_subtitle'=> $row['slide_subtitle'],
                    'description'   => $row['description'],
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
