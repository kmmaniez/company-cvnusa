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

    }
}
