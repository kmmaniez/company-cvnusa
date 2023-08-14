<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = fake('id_ID');

        $data = [
            [
                'username'  => 'writerlorem',
                'name'      => 'WriterName Program',
                'email'     => 'writer@gmail.com',
                'role'      => ['writer'],
            ],
            [
                'username'  => 'adminlorem',
                'name'      => 'AdminName Program',
                'email'     => 'admin@gmail.com',
                'role'      => ['admin'],
            ],
            [
                'username'  => 'Super Lorem',
                'name'      => 'Super Program',
                'email'     => 'super@gmail.com',
                'role'      => ['super'],
            ]
        ];

        foreach ($data as $row) {
            try {
                $user = User::create([
                    'username'  => $row['username'],
                    'name'      => $row['name'],
                    'email'     => $row['email'],
                    'password'  => Hash::make('password')
                ]);
                $user->assignRole($row['role']);
            } catch (\Throwable $th) {
                throw $th;
            }
        }

        for ($i=0; $i < 12; $i++) { 
            $users = User::create([
                'username'  => $faker->userName(),
                'name'      => $faker->name(),
                'email'     => $faker->email(),
                'password'  => Hash::make('password')
            ]);
            $users->assignRole('writer');
        }

    }
}
