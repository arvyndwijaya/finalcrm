<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Helpers\UniqueCodeHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MCustomerReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'           => UniqueCodeHelper::generateReceiptCode(),
            'name'           => Str::random(40),
            'customer_id'    => rand(1, 10),
            'spheris_right'  => date('i.s'),
            'spheris_left'   => date('i.s'),
            'cylinder_right' => date('i.s'),
            'cylinder_left'  => date('i.s'),
            'addition_right' => date('i.s'),
            'addition_left'  => date('i.s'),
            'axis_right'     => rand(10, 100),
            'axis_left'      => rand(10, 100),
            'created_at'     => now()
        ];
    }
}
