<?php

namespace Database\Factories;

use App\Helpers\UniqueCodeHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrxHSalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice'     => UniqueCodeHelper::generateSalesOrderCode(),
            'customer_id' => rand(1, 10),
            'date'        => fake()->date(),
            'created_at'  => now()
        ];
    }
}
