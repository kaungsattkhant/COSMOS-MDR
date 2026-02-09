<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uom;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $uoms = [
            // Brick / Construction
            ['uom_code' => 'PCS',  'name' => 'Pieces',      'type' => 'quantity'],
            ['uom_code' => 'BRK',  'name' => 'Bricks',      'type' => 'quantity'],
            ['uom_code' => 'PAL',  'name' => 'Pallet',      'type' => 'quantity'],

            // Raw Materials
            ['uom_code' => 'KG',   'name' => 'Kilogram',    'type' => 'weight'],
            ['uom_code' => 'TON',  'name' => 'Ton',         'type' => 'weight'],
            ['uom_code' => 'BAG',  'name' => 'Bag',         'type' => 'weight'],

            // Liquids
            ['uom_code' => 'LTR',  'name' => 'Liter',       'type' => 'volume'],
            ['uom_code' => 'GAL',  'name' => 'Gallon',      'type' => 'volume'],

            // General
            ['uom_code' => 'BOX',  'name' => 'Box',         'type' => 'quantity'],
            ['uom_code' => 'SET',  'name' => 'Set',         'type' => 'quantity'],
        ];

        foreach ($uoms as $uom) {
            Uom::firstOrCreate(
                ['uom_code' => $uom['uom_code']],
                [
                    'name'      => $uom['name'],
                    // 'type'      => $uom['type'], //not used
                    'is_active' => true,
                ]
            );
        }
    }
}
