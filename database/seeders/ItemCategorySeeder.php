<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Clay', 'Sand', 'Octane', 'Diesel'];

        foreach ($categories as $name) {
            ItemCategory::updateOrCreate(
                ['name' => $name],
                ['is_active' => true]
            );
        }
    }
}
