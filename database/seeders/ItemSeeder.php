<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\ItemSupplierPrice;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = Supplier::all();

        Item::factory(20)->create()->each(function ($item) use ($suppliers) {
            if ($suppliers->isNotEmpty()) {
                $randomSuppliers = $suppliers->random(rand(1, min(3, $suppliers->count())));
                foreach ($randomSuppliers as $supplier) {
                    ItemSupplierPrice::create([
                        'item_id' => $item->id,
                        'supplier_id' => $supplier->id,
                        'price' => rand(1, 100) * 100,
                        'effective_date' => now(),
                        'is_active' => true,
                    ]);
                }
            }
        });
    }
}
