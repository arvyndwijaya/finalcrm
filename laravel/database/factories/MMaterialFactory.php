<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Helpers\UniqueCodeHelper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'       => UniqueCodeHelper::generateMaterialCode(),
            'name'       => fake()->words(3, true),
            'price'      => fake()->randomNumber(7, true),
            'created_at' => now()
        ];
    }
}
