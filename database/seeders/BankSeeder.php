<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name' => 'AYA Bank'],
            ['name' => 'KBZ Bank'],
            ['name' => 'CB Bank'],
            ['name' => 'UAB Bank'],
            ['name' => 'Yoma Bank'],
        ];

        foreach ($banks as $bank) {
            Bank::firstOrCreate(
                ['name' => $bank['name']],   // search condition
                ['is_active' => true]        // default values
            );
        }
    }
}
