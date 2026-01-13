<?php

namespace Database\Factories; 

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Purchase;

class ProductFactory extends Factory
{
   
    public function definition()
    {
        return [
            'purchase_id' => Purchase::factory(),
            'price' => $this->faker->numberBetween(150, 1500),
            'discount' => $this->faker->numberBetween(0, 50),
            'description' => $this->faker->sentence(),
        ];
    }
}
