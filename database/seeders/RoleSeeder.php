<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DATA PERMISSION LIST REFERENSI DARI PermissionSeeder
        $permission_lists = Permission::all();

        try {
            
            // WRITER HANYA BISA MANAGE BLOG,PROJECTS,CLIENTS,PRICES,SERVICES
            $role1 = Role::create(['name' => 'writer']);

            foreach ($permission_lists as $key => $value) {
                if ($key == 0 || $key == 2 || $key == 3 || $key == 4 || $key == 5 || $key == 6 || $key == 7) {
                    continue;
                }
                $role1->givePermissionTo([$value]);
            }

            // ADMIN HANYA BISA MANAGE BLOG,PROJECTS,CLIENTS,PRICES,SERVICES,TEAMS,WEBSITE
            $role2 = Role::create(['name' => 'admin']);
            foreach ($permission_lists as $key => $value) {
                if ($key == 0) {
                    // all permissions kecuali manage-users
                    continue;
                }
                $role2->givePermissionTo([$value]);
            }

            // SUPER BISA MANAGE SEMUA
            $role3 = Role::create(['name' => 'super']);
            foreach ($permission_lists as $key) {
                $role3->givePermissionTo([$key]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
