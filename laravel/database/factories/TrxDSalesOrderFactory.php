<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrxDSalesOrder>
 */
class TrxDSalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'so_h_id'        => rand(1, 10),
            'material_id'    => rand(1, 100),
            'material_code'  => 'M00000'.rand(001, 100),
            'material_name'  => fake()->words(3, true),
            'material_price' => fake()->randomNumber(7, true),
            'qty'            => rand(1, 4)
        ];
    }
}
