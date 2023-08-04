<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission_lists = [
            'manage-user',
            'manage-project',
            'manage-price',
            'manage-service',
            'manage-team',
            'manage-website',
        ];
        try {
            // create writer role and assign the permissions
            $role1 = Role::create(['name' => 'writer']);
            $role1->givePermissionTo([
                'manage-project',
                'manage-price',
                'manage-service',
            ]);

            // create admin role and assign the permissions
            $role2 = Role::create(['name' => 'admin']);
            $role2->givePermissionTo([
                'manage-project',
                'manage-price',
                'manage-service',
                'manage-team',
                'manage-website',
            ]);

            // create super role and assign the permissions
            $role3 = Role::create(['name' => 'super']);
            foreach ($permission_lists as $key) {
                $role3->givePermissionTo([$key]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
