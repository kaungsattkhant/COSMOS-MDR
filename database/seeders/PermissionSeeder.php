<?php

namespace Database\Seeders;

use App\Models\User;
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
        //sync permissions to superadmin
        $user=User::where('username','superadmin')->first();
        if($user){
            $permissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();
            // Sync permissions to user
            $user->syncPermissions($permissions);
        }
    }
}
