<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Uom;
use App\Models\ItemCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(2, true);

        return [
            'code'              => strtoupper($this->faker->unique()->regexify('[A-Z0-9]{6,10}')),
            'name'              => $name,
            'description'       => $this->faker->optional()->sentence(),
            'uom_id'  => Uom::inRandomOrder()->first()?->id ,
            'item_category_id'  => ItemCategory::query()->inRandomOrder()->first()?->id,
            'is_active'         => true,
        ];
    }
}
