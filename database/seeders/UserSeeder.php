<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(['username' => 'superadmin', 'phone_number' => '091234', 'email' => 'superadmin@example.com', 'type' => UserTypeEnum::SUPERADMIN->value], [
            'username' => 'superadmin',
            'phone_number' => '091234',
            'password' => bcrypt('password'),
            'email' => 'superadmin@example.com',
            'type' => UserTypeEnum::SUPERADMIN->value,
        ]);
        // $user=User::factory()->firstOrCreate(['username' => 'superadmin', 'phone_number' => '091234', 'email' => 'superadmin@example.com', 'type' => UserTypeEnum::SUPERADMIN->value],[
        //     'username' => 'superadmin',
        //     'phone_number' => '091234',
        //     'email' => 'superadmin@example.com',
        //     'type' => UserTypeEnum::SUPERADMIN->value,
        // ]);
        // Get all permissions (or specific ones)
        $permissions = Permission::where('guard_name', 'admin')->pluck('name')->toArray();

        // Sync permissions to user
        $user->syncPermissions($permissions);
        User::factory()->count(20)->create([
            'type' => UserTypeEnum::ADMIN->value,
        ]);
        User::factory()->count(20)->create([
            'type' => UserTypeEnum::STAFF->value,
        ]);
    }
}
