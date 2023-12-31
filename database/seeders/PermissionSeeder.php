<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permission_lists = [
            'manage-users',
            'manage-blogs',
            'manage-projects',
            'manage-clients',
            'manage-prices',
            'manage-services',
            'manage-teams',
            'manage-websites',
        ];
        try {
            foreach ($permission_lists as $key) {
                Permission::create(['name' => $key]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
