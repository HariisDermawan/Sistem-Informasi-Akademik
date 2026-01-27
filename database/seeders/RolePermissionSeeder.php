<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            app()[PermissionRegistrar::class]->forgetCachedPermissions();
            $p1 = Permission::create(['name' => 'kelola-prodi', 'guard_name' => 'web']);
            $p2 = Permission::create(['name' => 'input-nilai', 'guard_name' => 'web']);
            $p3 = Permission::create(['name' => 'ambil-krs', 'guard_name' => 'web']);
            Role::create(['name' => 'admin', 'guard_name' => 'web'])->givePermissionTo($p1);
            Role::create(['name' => 'dosen', 'guard_name' => 'web'])->givePermissionTo($p2);
            Role::create(['name' => 'mahasiswa', 'guard_name' => 'web'])->givePermissionTo($p3);
        }
    }
}
