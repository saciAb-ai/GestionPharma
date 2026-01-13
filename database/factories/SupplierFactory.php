<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->companyEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->company(),
            'address' => $this->faker->address(),
            'product' => $this->faker->word(),
            'comment' => $this->faker->sentence(),
        ];
    }
}
    
