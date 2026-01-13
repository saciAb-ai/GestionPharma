<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class SaleFactory extends Factory
{

    public function definition()
    {
        // Ensure a product exists or create one
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $quantity = $this->faker->numberBetween(1, 10);
        
        return [
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity, // Assuming price is on product
        ];
    }
}
    
