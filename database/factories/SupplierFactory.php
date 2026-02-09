<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'         => $this->faker->company(),
            'supplier_code'         => $this->faker->unique()->regexify('[A-Z0-9]{6,10}'),
            'phone_number' => $this->faker->unique()->phoneNumber(),
            'email'        => $this->faker->unique()->safeEmail(),
            'address'      => $this->faker->address(),
            'bank_account_no' => $this->faker->unique()->bankAccountNumber(),
            'bank_id'           => Bank::inRandomOrder()->first()?->id ?? Bank::factory(),
            'credit_limit_amount' => $this->faker->randomFloat(2, 0, 1000000),
            'is_active'    => true,
        ];
    }
}
