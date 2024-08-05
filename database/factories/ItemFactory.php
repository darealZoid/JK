<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
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
            'barcode' => $this->faker->unique()->ean13,
            'item_name' => $this->faker->word,
            'item_description' => $this->faker->sentence,
            'maximum_stock_ratio' => $this->faker->randomFloat(2, 1, 100),
            'reorder_point' => $this->faker->randomFloat(2, 1, 50),
            'vat_type' => $this->faker->randomElement(['Vat', 'Non vat']),
            'vat_amount' => $this->faker->optional()->randomFloat(2, 0, 25),
            'status_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}