<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Supplier;
use Carbon\Carbon;

class PurchaseFactory extends Factory
{
   
    public function definition()
    {
        return [
            'product' => $this->faker->words(3, true), // Adjusted to valid faker method
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'supplier_id' => Supplier::inRandomOrder()->first()->id ?? Supplier::factory(),
            'cost_price' => $this->faker->numberBetween(100, 1000),
            'quantity' => $this->faker->numberBetween(10, 500),
            'expiry_date' => Carbon::now()->addMonths(rand(6, 36))->format('Y-m-d'),
            'image' => null,
        ];
    }
}
