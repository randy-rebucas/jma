<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */

use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->words(3, true),
            'cost_price' => fake()->numberBetween($min = 1000, $max = 9000),
            'unit_price' => fake()->numberBetween($min = 1000, $max = 9000),
            'selling_price' => fake()->numberBetween($min = 1000, $max = 9000),
            'reorder_level' => fake()->numberBetween(0, 10),
            'receiving_quantity' => fake()->numberBetween(0, 100),
            'part_number' => fake()->numberBetween(0, 100),
            'category_id' => Category::factory()->create()->id, //Category::all()->pluck('id')->random(),
            'supplier_id' => Supplier::first()->id
        ];
    }
}
