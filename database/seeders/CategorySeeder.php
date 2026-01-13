<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Médicaments', 'Antibiotiques', 'Compléments Alimentaires', 'Dermocosmétique', 'Matériel Médical'];
        
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }
        
        // Generate fake categories
        // Category::factory()->count(5)->create();
    }
}
