<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Helpers\UniqueCodeHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MCustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'         => UniqueCodeHelper::generateCustomerCode(),
            'name'         => fake()->name(),
            'birth_date'   => today(),
            'address'      => fake()->address(),
            'city'         => Arr::random(['BEKASI', 'JAKARTA', 'BOGOR', 'DEPOK', 'TANGERANG', 'SUKABUMI']),
            'no_handphone' => fake()->unique()->e164PhoneNumber(),
            'email'        => fake()->unique()->safeEmail(),
            'created_at'   => now()
        ];
    }
}
