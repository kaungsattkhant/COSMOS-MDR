<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'superadmin',
            'phone_number' => '091234',
            'email' => 'superadmin@example.com',
            'type' => UserTypeEnum::SUPERADMIN->value,
        ]);

        User::factory()->count(10)->create([
            'type' => UserTypeEnum::ADMIN->value,
        ]);
        User::factory()->count(10)->create([
            'type' => UserTypeEnum::STAFF->value,
        ]);
    }
}
