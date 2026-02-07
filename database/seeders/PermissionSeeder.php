<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/Data/permissions.json');
        $permissions = json_decode(file_get_contents($path), true);

        foreach ($permissions as $group => $items) {
            foreach ($items as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'guard_name' => 'admin',
                ]);
            }
        }
    }
}
